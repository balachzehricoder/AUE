<?php 
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include necessary files
include 'includes/sidebar.php';
include 'includes/header.php';

// Database connection
include 'confiq.php';

// Get the logged-in user's ID from the session
$user_id = $_SESSION['user_id'];

// Fetch Total Points (Specific to the logged-in user)
if (!isset($_SESSION['total_points'])) {
    $query_points = "SELECT SUM(points) AS total_points FROM users WHERE id = '$user_id'";
    $result_points = mysqli_query($conn, $query_points);
    $row_points = mysqli_fetch_assoc($result_points);
    $_SESSION['total_points'] = $row_points['total_points'] ?? 0;
}

// Fetch Total Group Points (Specific to the logged-in user)
if (!isset($_SESSION['total_group_points'])) {
    $query_group_points = "SELECT SUM(group_points) AS total_group_points FROM users WHERE id = '$user_id'";
    $result_group_points = mysqli_query($conn, $query_group_points);
    $row_group_points = mysqli_fetch_assoc($result_group_points);
    $_SESSION['total_group_points'] = $row_group_points['total_group_points'] ?? 0;
}

// Fetch Total Commission (Specific to the logged-in user)
if (!isset($_SESSION['total_commission'])) {
    $query_commission = "SELECT SUM(commission) AS total_commission FROM users WHERE id = '$user_id'";
    $result_commission = mysqli_query($conn, $query_commission);
    $row_commission = mysqli_fetch_assoc($result_commission);
    $_SESSION['total_commission'] = $row_commission['total_commission'] ?? 0;
}

// Fetch Daily Points (Specific to the logged-in user)
if (!isset($_SESSION['daily_points'])) {
    $query_daily_points = "SELECT DATE(created_at) AS date, SUM(points) AS daily_points FROM users WHERE id = '$user_id' GROUP BY DATE(created_at) ORDER BY DATE(created_at) DESC LIMIT 7";
    $result_daily_points = mysqli_query($conn, $query_daily_points);
    $daily_points = [];
    $dates = [];
    while ($row = mysqli_fetch_assoc($result_daily_points)) {
        $daily_points[] = $row['daily_points'];
        $dates[] = date('D', strtotime($row['date']));
    }
    $_SESSION['daily_points'] = $daily_points;
    $_SESSION['dates'] = $dates;
}

// Fetch Daily Group Points (Specific to the logged-in user)
if (!isset($_SESSION['daily_group_points'])) {
    $query_daily_group_points = "SELECT DATE(created_at) AS date, SUM(group_points) AS daily_group_points FROM users WHERE id = '$user_id' GROUP BY DATE(created_at) ORDER BY DATE(created_at) DESC LIMIT 7";
    $result_daily_group_points = mysqli_query($conn, $query_daily_group_points);
    $daily_group_points = [];
    while ($row = mysqli_fetch_assoc($result_daily_group_points)) {
        $daily_group_points[] = $row['daily_group_points'];
    }
    $_SESSION['daily_group_points'] = $daily_group_points;
}

// Fetch User Level based on total points
// Fetch User Level based on total points
$query_level = "SELECT l.level_name 
                FROM users u 
                LEFT JOIN levels l ON u.level = l.id 
                WHERE u.id = '$user_id'";
$result_level = mysqli_query($conn, $query_level);

if ($result_level) {
    $row_level = mysqli_fetch_assoc($result_level);
    $user_level = $row_level['level_name'] ?? 'Not Assigned';
} else {
    $user_level = 'Not Assigned';
}

?>

<!-- User Dashboard -->
<div class="container-fluid py-2">
  <div class="row">
    <!-- Total Points Card -->
    <div class="col-xl-3 col-sm-6 mb-4">
      <div class="card">
        <div class="card-header p-3">
          <p class="text-sm mb-0">Total Points</p>
          <h4 class="mb-0"><?php echo number_format($_SESSION['total_points']); ?></h4>
        </div>
      </div>
    </div>

    <!-- Total Group Points Card -->
    <div class="col-xl-3 col-sm-6 mb-4">
      <div class="card">
        <div class="card-header p-3">
          <p class="text-sm mb-0">Total Group Points</p>
          <h4 class="mb-0"><?php echo number_format($_SESSION['total_group_points']); ?></h4>
        </div>
      </div>
    </div>

    <!-- Total Commission Card -->
    <div class="col-xl-3 col-sm-6 mb-4">
      <div class="card">
        <div class="card-header p-3">
          <p class="text-sm mb-0">Total Commission</p>
          <h4 class="mb-0">$<?php echo number_format($_SESSION['total_commission'], 2); ?></h4>
        </div>
      </div>
    </div>

    <!-- User Level Card -->
    <div class="col-xl-3 col-sm-6 mb-4">
      <div class="card">
        <div class="card-header p-3">
          <p class="text-sm mb-0">User Level</p>
          <h4 class="mb-0"><?php echo $user_level; ?></h4>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts -->
  <div class="row">
    <!-- Points Chart -->
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-body">
          <h6>Daily Points</h6>
          <canvas id="pointsChart" height="170"></canvas>
        </div>
      </div>
    </div>

    <!-- Group Points Chart -->
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-body">
          <h6>Daily Group Points</h6>
          <canvas id="groupPointsChart" height="170"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Points Chart
  var ctxPoints = document.getElementById('pointsChart').getContext('2d');
  var pointsChart = new Chart(ctxPoints, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($_SESSION['dates']); ?>,
      datasets: [{
        label: 'Points',
        data: <?php echo json_encode($_SESSION['daily_points']); ?>,
        borderColor: 'rgba(75, 192, 192, 1)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderWidth: 2,
        fill: true,
        pointBackgroundColor: 'rgba(75, 192, 192, 1)',  // Point color
        tension: 0.4, // Smooth line
      }]
    },
    options: {
      responsive: true,
      plugins: {
        tooltip: {
          callbacks: {
            label: function(tooltipItem) {
              return 'Points: ' + tooltipItem.raw;
            }
          }
        }
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Days'
          }
        },
        y: {
          title: {
            display: true,
            text: 'Points'
          },
          beginAtZero: true
        }
      }
    }
  });

  // Group Points Chart
  var ctxGroupPoints = document.getElementById('groupPointsChart').getContext('2d');
  var groupPointsChart = new Chart(ctxGroupPoints, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($_SESSION['dates']); ?>,
      datasets: [{
        label: 'Group Points',
        data: <?php echo json_encode($_SESSION['daily_group_points']); ?>,
        backgroundColor: 'rgba(153, 102, 255, 0.6)',
        borderColor: 'rgba(153, 102, 255, 1)',
        borderWidth: 1,
        hoverBackgroundColor: 'rgba(153, 102, 255, 0.8)', // Hover effect
        hoverBorderColor: 'rgba(153, 102, 255, 1)',  // Hover border color
        barPercentage: 0.5,  // Bar width
      }]
    },
    options: {
      responsive: true,
      plugins: {
        tooltip: {
          callbacks: {
            label: function(tooltipItem) {
              return 'Group Points: ' + tooltipItem.raw;
            }
          }
        }
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Days'
          }
        },
        y: {
          title: {
            display: true,
            text: 'Group Points'
          },
          beginAtZero: true
        }
      }
    }
  });
</script>

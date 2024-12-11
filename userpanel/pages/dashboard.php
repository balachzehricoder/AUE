<?php 
// Include necessary files for header, sidebar, etc.
include 'includes/sidebar.php';
include 'includes/header.php';

// Include your database connection file (assuming it's named db_config.php)
// include './admin/config.php';


// Query to sum up points for today
// $query = "SELECT SUM(points) AS total_points FROM users WHERE DATE(created_at) = CURDATE()";
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($result);
// $total_points_today = $row['total_points'] ? $row['total_points'] : 0; // Default to 0 if no points today

?>

<!-- End Navbar -->

<div class="container-fluid py-2">
  <div class="row">
    <div class="ms-3">
      <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
      <p class="mb-4">Check the sales, value and bounce rate by country.</p>
    </div>
    <!-- Today's Points Card -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Today's Points</p>
              <h4 class="mb-0"><?php echo number_format($total_points_today); ?></h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+55% </span>than last week</p>
        </div>
      </div>
    </div>

    <!-- Other Dashboard Cards (Unchanged) -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Today's</p>
              <h4 class="mb-0">2300</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">person</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span>than last month</p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Ads Views</p>
              <h4 class="mb-0">3,462</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">leaderboard</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span>than yesterday</p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Sales</p>
              <h4 class="mb-0">$103,430</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than yesterday</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="mb-0">Website Views</h6>
          <p class="text-sm">Last Campaign Performance</p>
          <div class="pe-2">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
          <hr class="dark horizontal">
          <div class="d-flex">
            <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">Campaign sent 2 days ago</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="mb-0">Daily Sales</h6>
          <p class="text-sm">(<span class="font-weight-bolder">+15%</span>) increase in today sales.</p>
          <div class="pe-2">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
          <hr class="dark horizontal">
          <div class="d-flex">
            <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">Updated 4 min ago</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mt-4 mb-3">
      <div class="card">
        <div class="card-body">
          <h6 class="mb-0">Completed Tasks</h6>
          <p class="text-sm">Last Campaign Performance</p>
          <div class="pe-2">
            <div class="chart">
              <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
          <hr class="dark horizontal">
          <div class="d-flex">
            <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">Just updated</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/uiconfig.php'; ?>

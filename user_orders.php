<?php


session_start();
include 'admin/confiq.php';




?>

<?php


$user_id = $_SESSION["user_id"];

$query = "SELECT * FROM orders where user_id='$user_id' ";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Users Management</title>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/project3.0/profile.php">back</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/project3.0/profile.php">back to profile managment</a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table tr:nth-child(even){background-color: #f2f2f2;}

        .table tr:hover {background-color: #ddd;}

        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <br><br><br>
    <h2 style="text-align:center;">My orders</h2>
    <br>
    <div class="table-responsive"> <!-- Add this div -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>total</th>
                    <th>delivary charges</th>
                    <th>order date and time</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    foreach ($result as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td>Rs   <?php echo number_format( $row['total']); ?></td>
                            <td><?php echo $row['delivery_charges']; ?></td>
                            <td><?php echo $row['order_date_time']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><a class="btn btn-primary" href="order_details.php?id=<?php echo $row['id']; ?>">View Details</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>

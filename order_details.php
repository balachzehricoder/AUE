<?php
session_start();
include 'admin/confiq.php';

$id = $_GET["id"];
$query = "SELECT od.id, o.user_id, u.full_name, p.img_upload, p.p_name, od.product_id, od.price, od.qty
FROM order_details od
JOIN orders o ON od.order_id = o.id
JOIN users u ON o.user_id = u.id
JOIN products p ON od.product_id = p.id
WHERE od.order_id = ?";



$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
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
    <a class="navbar-brand" href="/project3.0/user_orders.php">back</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/project3.0/user_orders.php">back to order history</a>
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
    <h2 style="text-align:center;">user management</h2>
    <br>
    <div class="table-responsive"> <!-- Add this div -->
        <table class="table">
            <thead>
                <tr>
                    <th>product id</th>
                    <th>product name</th>
                    <th>user id</th>
                    <th>user name</th>
                    <th>product img</th>
                    <th>product price</th>
                    <th>product qty</th>


                </tr>
            </thead>
            <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['p_name']; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><img height="50px" src="<?php echo $row['img_upload']; ?>" alt="User Image" class="img"></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['qty']; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

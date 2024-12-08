<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Products Management</title>
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
    <a class="btn btn-primary" href="upload.php">Back</a>
    <br><br><br>
    <h2 style="text-align:center;">List of Products</h2>
    <a class="btn btn-primary"  href="/project3.0/upload.php" role="button">Add Product</a>
    <br>
    <div class="table-responsive"> <!-- Add this div -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Category No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
include_once('../../includes/config.php');
$sql = "SELECT * FROM products";
                $result = $conn->query($sql);
                if (!$result) {
                    die("invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
<td>$row[id]</td>
<td><img src='$row[img_upload]' alt='$row[p_name]' class='img-thumbnail' width='100'></td>
<td>$row[p_name]</td>
<td>$row[p_price]</td>
<td>$row[category_id]</td>
<td>
    <a class='btn btn-danger btn-sm' href='productsdelete.php?id=$row[id]'>Delete</a>
    <a class='btn btn-primary btn-sm' href='productedit.php?id=$row[id]'>Edit</a>
</td>
</tr>";
                }
                ?>
            </tbody>
        </table>
    </div> <!-- Close the div -->
    
</body>
</html>
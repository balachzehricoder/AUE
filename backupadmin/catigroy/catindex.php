<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Categories Management</title>
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
    <a class="btn btn-primary" href="/project3.0/admin/index.php">Back</a>
    <br><br><br>
    <h2 style="text-align:center;">List of Categories</h2>
    <a class="btn btn-primary"  href="/project3.0/cat/catindex.php" role="button">Add Category</a>
    <br>
    <div class="table-responsive"> <!-- Add this div -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Category Picture</th>
                    <th>Category Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
include '../includes/config.php';
$sql = "SELECT * FROM categories";
                $result = $conn->query($sql);
                if (!$result) {
                    die("invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
<td>$row[id]</td>
<td><img src='$row[picture]' alt='$row[name]' class='img-thumbnail' width='100'></td>
<td>$row[name]</td>
<td>$row[description]</td>
</tr>";
                }
                ?>
            </tbody>
        </table>
    </div> <!-- Close the div -->
</body>
</html>
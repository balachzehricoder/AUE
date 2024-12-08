<?php
include_once('../../includes/config.php');

$error = "";

if (isset($_POST['submit'])) {
	$p_qty = $_POST['p_qty'];
	$p_price = $_POST['p_price'];
	$p_name = $_POST['p_name'];
	$p_tax = $_POST['p_tax'];
	$cat_id = $_POST['cat_id'];

	// Check if all required fields are filled
	if ($p_qty != "" && $p_price != "" && $p_name != "" && $p_tax != "" && $cat_id != "") {

		// Upload image and get the file path
		include '../../image_upload.php';
		$fileResult = UploadImage($_FILES["uploadimg"]);
		$path = $fileResult["uploadedFile"];

		// Prepare and execute the INSERT query
		$query = "INSERT INTO products (p_qty, p_price, p_tax, p_name, img_upload, category_id) VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("sssssi", $p_qty, $p_price, $p_tax, $p_name, $path, $cat_id);

		if ($stmt->execute()) {
			$error = "<script>alert('Successful')</script>";
		} else {
			$error = "<script>alert('Your product could not be added')</script>";
		}
		$stmt->close();
	} else {
		$error = "<script>alert('Please fill in all fields')</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="icon" href="phonesell.com_logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="icon" href="logo.png">
    <a class="btn btn-primary" href="admin/products/productsindex.php">Back</a>

    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            background-color: #f4f4f4;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container .form-group .inp {
            font-weight: 800;
            font-style: italic;
        }

        .form-container .form-group .inp:hover {
            color: lightblue;
            font-weight: bolder;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Add Product</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="p_name" class="inp">Product Name:</label>
                <input type="text" class="form-control inp" id="p_name" name="p_name" placeholder="Product Name">
            </div>
            <div class="form-group">
                <label for="p_price" class="inp">Product Price:</label>
                <input type="text" class="form-control inp" id="p_price" name="p_price" placeholder="Product Price">
            </div>
            <div class="form-group">
			<label for="p_qty" class="inp">Product Quantity:</label>
                <input type="text" class="form-control inp" id="p_qty" name="p_qty" placeholder="Product Quantity">
            </div>
            <div class="form-group">
                <label for="p_tax" class="inp">Product Tax:</label>
                <input type="text" class="form-control inp" id="p_tax" name="p_tax" placeholder="Product Tax">
            </div>
            <div class="form-group">
                <label for="cat_id" class="inp">Category ID:</label>
                <input type="number" class="form-control inp" id="cat_id" name="cat_id" placeholder="Category ID">
            </div>
            <div class="form-group">
                <label for="uploadimg" class="inp">Product Image:</label>
                <input type="file" class="form-control inp" id="uploadimg" name="uploadimg">
            </div>
            <br><br><br>
            <center>
                <button name="submit" class="btn btn-primary">Submit</button>
            </center>
        </form>
    </div>
    <script>
        // Add your JavaScript code here
    </script>
    
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
    <br><br><br>
    <h2 style="text-align:center;">List of Categories</h2>
    <br>
    <div class="table-responsive"> <!-- Add this div -->
        <table class="table">
            <thead>
                <tr>
                    <th> Category ID</th>
                    <th>Category Name</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';
                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);
                if (!$result) {
                    die("invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
<td>$row[id]</td>
<td>$row[name]</td>
</tr>";
                }
                ?>
            </tbody>
        </table>
    </div> <!-- Close the div -->
</body>
</html>

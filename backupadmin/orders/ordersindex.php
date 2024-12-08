<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Orders Management</title>
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
    <style>
    #preloader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: rgba(0,0,0,0.5);
        display: none;
        align-items: center;
        justify-content: center;
    }
    .spinner {
        border: 16px solid #f3f3f3;
        border-top: 16px solid #3498db;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
</head>
<body>
<div id="preloader">
    <div class="spinner"></div>
</div>
    <a class="btn btn-primary" href="/project3.0/admin/index.php">Back</a>
    <br><br><br>
    <h2 style="text-align:center;">List of Orders</h2>
    <br>
    <div class="table-responsive"> <!-- Add this div -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Total</th>
                    <th>Delivery Charges</th>
                    <th>Order Date Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
include '../includes/config.php';
$sql = "SELECT * FROM orders";
                $result = $conn->query($sql);
                if (!$result) {
                    die("invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
<td>$row[id]</td>
<td>$row[user_id]</td>
<td>$row[total]</td>
<td>$row[delivery_charges]</td>
<td>$row[order_date_time]</td>
<td>$row[status]</td>
<td>
    <a class='btn btn-danger btn-sm' href='orderstaus.php?id=$row[id]'>Change Status</a>
</td>
</tr>";
                }
                ?>
            </tbody>
        </table>
    </div> <!-- Close the div -->
</body><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>   
    $(document).ready(function() {
        // Add event listener to the Change Status button
        $('.btn-danger').on('click', function(e) {
            e.preventDefault(); // Prevent the link from redirecting immediately
            // Show the preloader
            $('#preloader').show();

            // Simulate a delay for the status change process
            setTimeout(function() {
                window.location.href = e.currentTarget.href; // Redirect to the link after the delay
            }, 2000); // Replace 2000 with the appropriate delay (in milliseconds)
        });
    });
</script>
</html>
<?php
session_start();
include 'admin/confiq.php';

$id = $_SESSION["user_id"];
$query = "SELECT * FROM users where id='$id' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    foreach ($result as $row) {
        $full_name = $row['full_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
    }
}

$order_id = $_GET['order_id'];

// Retrieve order details from the database
$query = "SELECT * FROM orders WHERE id = '$order_id'";
$orders = $conn->query($query);
$orders = mysqli_fetch_assoc($orders);

// Retrieve order details from the database
$query = "SELECT od.*, p_name FROM order_details od JOIN products p ON od.product_id = p.id WHERE od.order_id = '$order_id'";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/20034a5f5a.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
        }

        .container {
            max-width: 900px;
            margin-top: 30px;
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-header h4 {
            font-weight: bold;
            color: #4caf50;
        }

        .invoice-header p {
            color: #555;
        }

        .invoice-details {
            margin-top: 20px;
        }

        .invoice-details .row {
            margin-bottom: 15px;
        }

        .invoice-details .col-md-6 {
            font-size: 16px;
            color: #333;
        }

        .invoice-details .col-md-6 strong {
            color: #4caf50;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .invoice-table th {
            background-color: #4caf50;
            color: white;
        }

        .invoice-table td {
            font-size: 16px;
            color: #555;
        }

        .total-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .total-section .total-price {
            color: #4caf50;
        }

        .invoice-footer {
            text-align: center;
            margin-top: 40px;
        }

        .invoice-footer .btn-print {
            background-color: #4caf50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .invoice-footer .btn-print:hover {
            background-color: #45a049;
        }

        .btn-back {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-back:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="invoice-header">
        <h4>Invoice #<?php echo $order_id; ?></h4>
        <p><strong>User Name:</strong> <?php echo $full_name; ?></p>
        <p><strong>Order Date:</strong> <?php echo date('F j, Y', strtotime($orders['order_date_time'])); ?></p>
    </div>

    <div class="invoice-details">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Address:</strong> <?php echo $address; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone:</strong> <?php echo $phone; ?></p>
                <p><strong>Payment:</strong> COD</p>
            </div>
            <div class="col-md-6 text-right">
                <p><strong>Shipping Method:</strong> Standard Delivery</p>
                <p><strong>Payment Status:</strong> unPaid</p>
            </div>
        </div>
    </div>

    <table class="invoice-table">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total_price = 0;
        while ($row = $result->fetch_assoc()) {
            $p_name = $row['p_name'];
            $price = $row['price'];
            $qty = $row['qty'];
            $subtotal = $price * $qty;
            $total_price += $subtotal;
            ?>
            <tr>
                <td><?php echo $p_name; ?></td>
                <td>PKR <?php echo number_format($price); ?></td>
                <td><?php echo $qty; ?></td>
                <td>PKR <?php echo number_format($subtotal); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <div class="total-section">
        <div>Total Amount: PKR <?php echo number_format($total_price); ?></div>
        <div>Shipping: PKR <?php echo number_format($orders["delivery_charges"]); ?></div>
        <div class="total-price">Total: PKR <?php echo number_format($total_price + $orders["delivery_charges"]); ?></div>
    </div>

    <div class="invoice-footer">
        <button class="btn-print" onclick="window.print()">Print Invoice</button>
    </div>

    <div class="text-center mt-4">
        <a href="index.php" class="btn-back">Return to Home</a>
    </div>
</div>

</body>

</html>

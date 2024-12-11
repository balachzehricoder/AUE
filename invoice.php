<?php
session_start();
include 'admin/confiq.php';

// Get the order_id from the URL
$order_id = $_GET['order_id'];

// Check if the user is logged in
$full_name = $email = $phone = $address = '';

// Check if user is logged in
if (isset($_SESSION["user_id"])) {
    $id = $_SESSION["user_id"];
    $query = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $full_name = $row['full_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
    }
} else {
    // If user is not logged in, fetch user info from the orders table
    $query = "SELECT customer_name, customer_email, customer_phone, customer_address FROM orders WHERE id='$order_id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $full_name = $row['customer_name'];
        $email = $row['customer_email'];
        $phone = $row['customer_phone'];
        $address = $row['customer_address'];
    }
}

// Retrieve order details from the database
$query = "SELECT * FROM orders WHERE id = '$order_id'";
$orders = $conn->query($query);
$orders = mysqli_fetch_assoc($orders);

// Retrieve order products from the database
$query = "SELECT od.*, p.p_name FROM order_details od JOIN products p ON od.product_id = p.id WHERE od.order_id = '$order_id'";
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

        .invoice-header h4 {
            font-weight: bold;
            color: #4caf50;
        }

        .invoice-table th, .invoice-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .total-section .total-price {
            color: #4caf50;
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
        <p><strong>Address:</strong> <?php echo $address; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Phone:</strong> <?php echo $phone; ?></p>
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

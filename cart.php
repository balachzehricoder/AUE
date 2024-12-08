<?php
session_start();
include 'admin/confiq.php';
include 'navandside.php';

// Check if the cart is empty.
if (empty($_SESSION['cart'])) {
    echo '<div class="text-center text-xl font-bold text-red-600">Your Cart Is Empty.</div>';
    echo '<br>';
    echo '<div class="text-center"><a href="index.php" class="bg-red-500 text-white px-6 py-2 rounded-lg">Return to Home</a></div>';
    exit;
}

$cart = $_SESSION['cart'];

$insert = false;
if (isset($_POST['submit'])) {
    $user_id = $_SESSION["user_id"];
    $total = $_SESSION['cart_details']['cart_total_price'];
    $delivery_charges = 200;
    $order_date_time = date('Y-m-d H:i:s');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_errno());
    }

    $sql = "INSERT INTO ORDERS (user_id, total, delivery_charges, order_date_time) VALUES ('$user_id', '$total', '$delivery_charges', '$order_date_time')";

    if ($conn->query($sql) === TRUE) {
        $order_id = mysqli_insert_id($conn);

        foreach ($cart as $product_id => $product) {
            $price = $product['price'];
            $qty = $product['quantity'];

            $sql = "INSERT INTO order_details (order_id, product_id, price, qty) VALUES ('$order_id', '$product_id', '$price', '$qty')";
            if ($conn->query($sql) === TRUE) {
                $insert = true;
                $_SESSION['cart'] = [];
            } else {
                echo "Error: $sql <br>" . $conn->error;
            }
        }

        $insert = true;
        $_SESSION['cart'] = null;
        $_SESSION['cart_details'] = null;

        include 'Email/email.php';

        header("Location: invoice.php?order_id=" . $order_id);
        exit;
    } else {
        echo "Error: $sql <br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
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
        @media (max-width: 768px) {
            #preloader {
                justify-content: center;
            }
            .spinner {
                width: 60px;
                height: 60px;
            }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-100">

<div id="preloader" style="display: none;">
    <div class="spinner"></div>
</div>

<div class="container mx-auto py-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center">Your Cart</h2>
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left">Product</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-left">Quantity/Update</th>
                    <th class="px-6 py-3 text-left">Price</th>
                    <th class="px-6 py-3 text-left">Points/BP</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($cart as $product_id => $product) {
                    $product_price = $product['price'];
                    $points_bp = $product['price'] * 0.1; // Points/Bonus Points (10% of price)
                    ?>
                    <tr class="border-b">
                        <td class="px-6 py-4"><img width="60" src="admin/<?php echo $product['image']; ?>" alt=""/></td>
                        <td class="px-6 py-4"><?php echo $product['name']; ?><br/>Color: Black, Material: Metal</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <input class="w-16 text-center" type="number" value="<?php echo $product['quantity']; ?>" readonly />
                                <a href="remove.php?product_id=<?php echo $product_id; ?>" class="bg-red-500 text-white px-2 py-1 ml-2 rounded-lg">Remove</a>
                            </div>
                        </td>
                        <td class="px-6 py-4">Rp<?php echo number_format($product_price); ?></td>
                        <td class="px-6 py-4">BP: <?php echo number_format($product['bp'] * $product['quantity']); ?><br/>Points: <?php echo number_format($product['points'] * $product['quantity']); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex justify-between">
            <p class="font-bold">Total Price: Rp<?php echo number_format($_SESSION['cart_details']['cart_total_price']); ?></p>
            <p class="font-bold">Total Bonus Points: <?php echo number_format($_SESSION['cart_details']['cart_total_bp']); ?></p>
            <p class="font-bold">Total Points: <?php echo number_format($_SESSION['cart_details']['cart_total_points']); ?></p>
        </div>
    </div>

    <div class="mt-6 text-center">
        <form action="" method="POST">
            <button type="submit" name="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg">Proceed to Checkout</button>
        </form>
    </div>
</div>

</body>
</html>
<?php include 'footer.php'?>
<?php
error_reporting(E_ALL);
session_start();

include 'admin/confiq.php';
include 'navandside.php';

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

    // Insert order data into the ORDERS table
    $sql = "INSERT INTO ORDERS (user_id, total, delivery_charges, order_date_time) 
            VALUES ('$user_id', '$total', '$delivery_charges', '$order_date_time')";

    if ($conn->query($sql) === TRUE) {
        $order_id = mysqli_insert_id($conn);

        // Calculate total points for the order
        $total_points = 0;
        foreach ($cart as $product_id => $product) {
            $price = $product['price'];
            $qty = $product['quantity'];
            $product_points = $product['points'];
            $total_points += $product_points * $qty;

            $sql = "INSERT INTO order_details (order_id, product_id, price, qty) 
                    VALUES ('$order_id', '$product_id', '$price', '$qty')";
            if ($conn->query($sql) === TRUE) {
                $insert = true;
            } else {
                echo "Error: $sql <br>" . $conn->error;
            }
        }

        // Update user's personal points and monthly points
        $user_query = "SELECT points, monthly_points FROM users WHERE id = '$user_id'";
        $result = $conn->query($user_query);
        $current_points = $current_monthly_points = 0;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_points = $row['points'];
            $current_monthly_points = $row['monthly_points'];
        }

        $new_points = $current_points + $total_points;
        $new_monthly_points = $current_monthly_points + $total_points;

        $update_user_points_query = "UPDATE users SET points = '$new_points', monthly_points = '$new_monthly_points' WHERE id = '$user_id'";
        if ($conn->query($update_user_points_query) === TRUE) {
            echo "User's personal and monthly points updated successfully.";
        } else {
            echo "Error updating user's points: " . $conn->error;
        }

        // Fetch the sponsor's unique ID based on the user's sponsor_id
        
        // Fetch the sponsor's ID from the logged-in user's data
        // Maximum levels for downline propagation
        $max_levels = 5; 
        $current_level = 1;
        
        // Commission chart for group points, income, and bonus
        $commission_chart = [
            1 => ['group_points' => 100, 'income' => 800, 'bonus' => 200],
            2 => ['group_points' => 200, 'income' => 1750, 'bonus' => 200],
            3 => ['group_points' => 300, 'income' => 3000, 'bonus' => 500],
            4 => ['group_points' => 400, 'income' => 4200, 'bonus' => 500],
            5 => ['group_points' => 500, 'income' => 6000, 'bonus' => 1000],
            6 => ['group_points' => 600, 'income' => 9500, 'bonus' => 1000],
            7 => ['group_points' => 700, 'income' => 11000, 'bonus' => 1500],
            8 => ['group_points' => 800, 'income' => 13000, 'bonus' => 1500],
            9 => ['group_points' => 900, 'income' => 15000, 'bonus' => 5000],
            10 => ['group_points' => 1000, 'income' => 17000, 'bonus' => 5000],
        ];
        
        // Fetch the first sponsor ID (direct sponsor)
        $sponsor_id_query = "SELECT sponsor_id FROM users WHERE id = '$user_id'";
        $sponsor_id_result = $conn->query($sponsor_id_query);
        
        if ($sponsor_id_result->num_rows > 0) {
            $sponsor_id_row = $sponsor_id_result->fetch_assoc();
            $current_sponsor_id = $sponsor_id_row['sponsor_id'];
        
            while (!empty($current_sponsor_id) && $current_level <= $max_levels) {
                // Find the sponsor's user record by unique_id
                $sponsor_query = "SELECT id, unique_id, sponsor_id, level, group_points FROM users WHERE unique_id = '$current_sponsor_id'";
                $sponsor_result = $conn->query($sponsor_query);
        
                if ($sponsor_result->num_rows > 0) {
                    $sponsor_row = $sponsor_result->fetch_assoc();
                    $sponsor_user_id = $sponsor_row['id']; // Sponsor's user ID
                    $next_sponsor_id = $sponsor_row['sponsor_id']; // Next sponsor in the chain
                    $current_sponsor_level = $sponsor_row['level']; // Current sponsor level
                    $current_group_points = $sponsor_row['group_points']; // Sponsor's current group points
        
                    // Get the group points, income, and bonus based on the sponsor's level
                    $group_points = isset($commission_chart[$current_sponsor_level]) ? $commission_chart[$current_sponsor_level]['group_points'] : 0;
                    $income = isset($commission_chart[$current_sponsor_level]) ? $commission_chart[$current_sponsor_level]['income'] : 0;
                    $bonus = isset($commission_chart[$current_sponsor_level]) ? $commission_chart[$current_sponsor_level]['bonus'] : 0;
        
                    // Calculate the new group points (accumulating with previous points)
                    $new_group_points = $current_group_points + $group_points;
        
                    // Update sponsor's group points, level, income, and bonus dynamically
                    $update_sponsor_query = "UPDATE users 
                                             SET group_points = '$new_group_points',
                                                 income = income + '$income',
                                                 bonus = bonus + '$bonus',
                                                 level = '$current_level'
                                             WHERE id = '$sponsor_user_id'";
        
                    if ($conn->query($update_sponsor_query) === TRUE) {
                        echo "Level $current_level sponsor (User ID: $sponsor_user_id) updated with $group_points group points.<br>";
                    } else {
                        echo "Error updating Level $current_level sponsor: " . $conn->error;
                    }
        
                    // Move to the next sponsor in the chain and increment the level
                    $current_sponsor_id = $next_sponsor_id;
                    $current_level++; // Increment the level for the next sponsor
                } else {
                    echo "Sponsor with unique_id $current_sponsor_id not found.<br>";
                    break; // Stop propagation if no sponsor found
                }
            }
        } else {
            echo "No direct sponsor found for the logged-in user.";
        }
        
        
        

        include 'Email/email.php'; // Send email after successful order

        unset($_SESSION['cart']);
        unset($_SESSION['cart_details']);

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
    <?php
$isLoggedIn = isset($_SESSION['user_id']); // Check if the user is logged in
?>

<form action="" method="POST">
    <button 
        type="submit" 
        name="submit" 
        class="px-6 py-2 rounded-lg 
            <?php echo $isLoggedIn ? 'bg-green-500 text-white hover:bg-green-600' : 'bg-gray-400 text-gray-600 cursor-not-allowed'; ?>" 
        <?php echo !$isLoggedIn ? 'disabled' : ''; ?>
    >
        Proceed to Checkout
    </button>
</form>

<?php if (!$isLoggedIn): ?>
    <p class="mt-2 text-red-600">You need to log in to proceed with checkout.</p>
<?php endif; ?>
</div>

</div>

</body>
</html>

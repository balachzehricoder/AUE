<?php
// Start session to handle cart and user data
session_start();

// Dummy cart data (replace with actual cart data from your application)
if (!isset($_SESSION['cart_details'])) {
    $_SESSION['cart_details'] = [
        'cart_items' => [
            1 => ['name' => 'Product 1', 'price' => 500, 'quantity' => 2],
            2 => ['name' => 'Product 2', 'price' => 250, 'quantity' => 1]
        ],
        'cart_total_price' => 1250, // Total price of cart
    ];
}

// Handle form submission for placing the order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Get shipping details from the form
    $email = $_POST['email'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $phone = $_POST['phone'];

    // Get shipping method (free or paid)
    $shipping_method = $_POST['shipping_method'];

    // Get payment method (card or COD)
    $payment_method = $_POST['payment_method'];

    // Billing address (check if same as shipping)
    $billing_address = isset($_POST['same_as_shipping']) ? 'Same as shipping address' : 'Different address';

    // Here, you can process the order (e.g., save to database, send email, etc.)

    // For now, let's display the order summary
    echo '<h2>Order Summary</h2>';
    echo '<p>Email: ' . htmlspecialchars($email) . '</p>';
    echo '<p>Name: ' . htmlspecialchars($name) . '</p>';
    echo '<p>Address: ' . htmlspecialchars($address) . ', ' . htmlspecialchars($city) . ', ' . htmlspecialchars($postal_code) . '</p>';
    echo '<p>Phone: ' . htmlspecialchars($phone) . '</p>';
    echo '<p>Shipping Method: ' . ($shipping_method == 'free' ? 'Free Delivery on orders over Rs 999' : 'Paid Delivery') . '</p>';
    echo '<p>Payment Method: ' . ($payment_method == 'card' ? 'Card Payment' : 'Cash on Delivery') . '</p>';
    echo '<p>Billing Address: ' . $billing_address . '</p>';

    // Display cart details
    echo '<h3>Cart Items</h3>';
    foreach ($_SESSION['cart_details']['cart_items'] as $product_id => $product) {
        echo '<p>' . htmlspecialchars($product['name']) . ' - Quantity: ' . $product['quantity'] . ' - Rs ' . number_format($product['price']) . '</p>';
    }

    echo '<p>Total Price: Rs ' . number_format($_SESSION['cart_details']['cart_total_price']) . '</p>';
    echo '<p>Thank you for your order!</p>';
    exit;
}
?>

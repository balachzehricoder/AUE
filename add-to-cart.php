<?php
session_start();
include 'admin/confiq.php';

// Check if the product ID is provided.
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

// Retrieve the product ID.
$product_id = $_GET['id'];

if (isset($_POST['add_to_cart'])) {
  $product_id = $_POST['product_id'];
  $_SESSION['cart'][] = $product_id;

  // Optionally, you can redirect the user back to the previous page or a cart page.
  header('Location: previous-page.php');
  exit;
}

// Check if the product exists in the database.
$query = "SELECT * FROM products WHERE id = '$product_id'";
$result = $conn->query($query);

if ($result->num_rows === 0) {
  echo 'Product not found.';
  exit;
}

// Retrieve the product details.
$product = $result->fetch_assoc();
$p_name = $product['p_name'];
$p_price = $product['p_price'];
$p_bp = $product['bp']; // Bonus Points field in database
$p_points = $product['points']; // Points field in database
$img_upload = $product['img_upload'];

// Add the product to the cart.
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

if (!isset($_SESSION['cart'][$product_id])) {
  $_SESSION['cart'][$product_id] = array(
      'name' => $p_name,
      'price' => $p_price,
      'quantity' => isset($p_qty)?$p_qty:1,
      'image' => $img_upload,
      'bp' => $p_bp,
      'points' => $p_points
  );
} else {
  if(isset($p_qty)) {
    $_SESSION['cart'][$product_id]['quantity'] = $p_qty;
  } else {
    $_SESSION['cart'][$product_id]['quantity']++;
  }
}

// Calculate total price, BP, and points
$_SESSION['cart_details']['cart_total_price'] = 0;
$_SESSION['cart_details']['cart_total_bp'] = 0;
$_SESSION['cart_details']['cart_total_points'] = 0;
$_SESSION['cart_details']['cart_total_qty'] = 0;

foreach ($_SESSION['cart'] as $prod_id => $prod) {
  $_SESSION['cart_details']['cart_total_price'] += $prod['price'] * $prod['quantity'];
  $_SESSION['cart_details']['cart_total_bp'] += $prod['bp'] * $prod['quantity'];
  $_SESSION['cart_details']['cart_total_points'] += $prod['points'] * $prod['quantity'];
  $_SESSION['cart_details']['cart_total_qty'] += $prod['quantity'];
}

header('Location: category.php');
?>

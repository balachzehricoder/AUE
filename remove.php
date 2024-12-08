<?php
session_start();
// Get the product ID from the URL.
$product_id = $_GET['product_id'];

// Remove the product from the cart.
unset($_SESSION['cart'][$product_id]);


$_SESSION['cart_details']['cart_total_price'] = 0;
$_SESSION['cart_details']['cart_total_qty'] = 0;

foreach ($_SESSION['cart'] as $prod_id => $prod) {
// print_r($prod);

	$_SESSION['cart_details']['cart_total_price'] += $prod['price_total'];
	$_SESSION['cart_details']['cart_total_qty'] += $prod['quantity'];
}




// print_r($_SESSION['cart_details']['cart_total_price']);
// echo "<br>";
// print_r($_SESSION['cart_details']['cart_total_qty']);
// exit;

// Redirect the user to the cart page.
header('Location: cart.php');

?>
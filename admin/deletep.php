<?php
include 'confiq.php';

// Fetch product ID from query parameter
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;

if ($product_id) {
    // Delete the product from the database
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        header("Location: post.php");
    } else {
        echo "Error deleting product: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

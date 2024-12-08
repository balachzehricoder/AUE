<?php
session_start(); // Start the session
include 'admin/confiq.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];
    
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Use prepared statement to prevent SQL injection
        $insert_query = "INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
        mysqli_stmt_execute($stmt);

        // Redirect back to the main page
        header("Location: category.php");
        exit();
    } else {
        if (isset($_COOKIE['wishlist'])) {
            $wishlist = unserialize($_COOKIE['wishlist']);
            if (is_array($wishlist) && !in_array($product_id, $wishlist)) {
                $wishlist[] = $product_id;
                // Store the updated wishlist array in the cookie
                setcookie('wishlist', serialize($wishlist), time() + (3600 * 24 * 30), '/');
            }
        }

        // Redirect back to the main page
        header("Location: category.php");
        exit();
    }
}
?>

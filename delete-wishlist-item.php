<?php
session_start();
include 'admin/confiq.php';

if (isset($_GET['id'])) {
    $wishlist_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Ensure that the user owns the wishlist item before deleting it
    $delete_query = "DELETE FROM wishlist WHERE wishlist_id	 = ? AND user_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("ii", $wishlist_id, $user_id);

    if ($stmt->execute()) {
        // Wishlist item deleted successfully
        header("Location: wishlistview.php"); // Redirect back to the wishlist page
        exit();
    } else {
        // Error handling (e.g., item not found or permission denied)
        echo "Error deleting wishlist item.";
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle the case where 'id' is not set in the URL
    echo "Invalid request.";
}



?>

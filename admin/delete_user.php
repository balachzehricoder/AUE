<?php
include 'confiq.php';

// Start output buffering
ob_start();

// Check if the 'user_id' is present in the URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Validate the user ID to prevent SQL Injection
    if (filter_var($user_id, FILTER_VALIDATE_INT)) {
        // Disable foreign key checks temporarily
        $conn->query("SET foreign_key_checks = 0");

        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            // Redirect after successful deletion
            header("Location: users.php");
            exit();
        } else {
            echo "Error deleting user: " . $conn->error;
        }

        // Re-enable foreign key checks
        $conn->query("SET foreign_key_checks = 1");

        $stmt->close();
    } else {
        echo "Invalid user ID.";
    }
} else {
    echo "User ID not provided.";
}

// End output buffering and clean the buffer
ob_end_flush();
?>

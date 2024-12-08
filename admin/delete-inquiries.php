<?php
include 'confiq.php'; // Your database configuration
// include 'header.php';
// include 'sidebar.php';

if (isset($_POST['delete']) && !empty($_POST['email_ids'])) {
    // Get the array of selected email IDs
    $email_ids = $_POST['email_ids'];

    // Sanitize the IDs to ensure they are integers (prevent SQL injection)
    $id_string = implode(',', array_map('intval', $email_ids));

    // SQL query to delete the selected emails
    $sql = "DELETE FROM service_inquiries WHERE id IN ($id_string)";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Selected emails deleted successfully.";
        header("Location: contact-inbox.php"); // Redirect back to the inbox after deletion
        exit();
    } else {
        echo "Error deleting emails: " . $conn->error;
    }
} else {
    echo "No emails selected for deletion.";
}
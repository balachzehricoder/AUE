<?php

// Step 1: Connect to the database
include '../includes/config.php';

// Step 2: Get the ID from request parameters (make sure to validate/sanitize it before use)
$id = $_GET["id"];

// Step 3: Update the status in the database
$status = "delivered"; // Set the status as "delivered"
$sql = "UPDATE orders SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $id);
$stmt->execute();

// Step 4: Retrieve the user email from the database
$sql = "SELECT email FROM users U INNER JOIN orders O ON U.id = O.user_id WHERE O.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    header("Location: profile.php");
    exit;
}

$email = $row["email"];

// Step 5: Send the email
// ... Your existing email sending code ...
include 'Email/email.php';

// Step 6: Redirect back to the list of records or show a confirmation message
header("Location: ordersindex.php");
exit();
?>

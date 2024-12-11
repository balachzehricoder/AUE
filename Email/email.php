<?php
session_start();
include './admin/confiq.php'; // Include your database connection

// Ensure user is logged in
if (!isset($_SESSION["user_id"])) {
    die("User not logged in");
}

// Get user details
$id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $full_name = $row['first_name'];
    $email = $row['email'];
    $phone = $row['mobile_number'];
    $address = $row['address'];
} else {
    die("User not found");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Base files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Email to user
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'phonesell7896@gmail.com'; // Sender email
    $mail->Password = 'wpeolucbkvtfmljy'; // Sender email password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('phonesell7896@gmail.com', "phonesell.com");
    $mail->addAddress($email, $full_name); // User's email
    $mail->Subject = 'Your Order Confirmation';
    $mail->Body = 'Hello ' . $full_name . ', your order has been placed successfully!';
    $mail->isHTML(true); // Set email format to HTML
    $mail->send();

    // Email to admin
    $mail->clearAddresses(); // Clear previous recipients
    $mail->addAddress("balachzehr@hotmail.com", "Admin"); // Admin email
    $mail->Subject = 'New Order Notification';
    $mail->Body = 'A new order has been placed by ' . $full_name . '. Please check it out.';
    $mail->send();

    echo 'Order confirmation and notification emails have been sent.';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>

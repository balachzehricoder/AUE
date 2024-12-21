<?php 
include 'confiq.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Base files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $user_email = $_POST['user_email'];

    // Update order status
    $update_query = "UPDATE orders SET status = 'Delivered' WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('i', $order_id);
    $stmt->execute();

    // Send email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // E.g., smtp.gmail.com
        $mail->SMTPAuth = true;
        $mail->Username = 'phonesell7896@gmail.com';
        $mail->Password = 'wpeolucbkvtfmljy';
        $mail->SMTPSecure = 'tls'; // Or 'ssl' for port 465
        $mail->Port = 587;

        // Email content
        $mail->setFrom('phonesell7896@gmail.com', 'AUE');
        $mail->addAddress($user_email);
        $mail->Subject = "Order Delivered";
        $mail->Body = "Your order number  has been delivered.";

        $mail->send();
        header("Location: orders.php");
        exit();
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

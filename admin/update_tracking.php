<?php
include 'confiq.php';  // Include the database connection
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Base files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $order_id = $_POST['order_id'];
    $tracking_number = $_POST['tracking_number'];
    $user_email = $_POST['user_email'];

    // Update the order with the tracking number in the database
    $update_query = "UPDATE orders SET tracking_number = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $tracking_number, $order_id);

    if ($stmt->execute()) {
        // Send email notification to the user
        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Use your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'phonesell7896@gmail.com';  // Your email
            $mail->Password = 'wpeolucbkvtfmljy';  // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('your-email@gmail.com', 'Your Name');
            $mail->addAddress($user_email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Order Tracking Number';
            $mail->Body    = "<p>Hello,</p>
                              <p>Your order  has been shipped. 
                              The tracking number is: <strong>$tracking_number</strong>.</p>
                              <p>Thank you for shopping with us!</p>";

            // Send the email
            $mail->send();

            // Redirect to the order page with success message
            header('Location: orders_page.php?message=Tracking number added successfully and email sent.');
            exit();
        } catch (Exception $e) {
            // If email sending fails
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error updating tracking number: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If the form is not submitted properly
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>

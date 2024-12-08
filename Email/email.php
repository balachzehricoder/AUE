<?php

include './admin/confiq.php';
$id = $_SESSION["user_id"];
$query = "SELECT * FROM users where id='$id'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $full_name = $row['full_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
    }
}


/* 
	https://github.com/PHPMailer/PHPMailer

	Download PHPMailer, open the zip file and extract the folder to your project directory.

	Rename the extracted directory to PHPMailer and write the below code inside of your php script (the script must be outside of the PHPMailer folder)
*/


// PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;
// Base files 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// create object of PHPMailer class with boolean parameter which sets/unsets exception.
$mail = new PHPMailer(true);                              
try {
    $mail->isSMTP(); // using SMTP protocol                                     
    $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
    $mail->SMTPAuth = true;  // enable smtp authentication                             
    $mail->Username = 'phonesell7896@gmail.com';  // sender gmail host              
    $mail->Password = 'wpeolucbkvtfmljy'; // sender gmail host password                          
    $mail->SMTPSecure = 'tls';  // for encrypted connection                           
    $mail->Port = 587;   // port for SMTP     

    $mail->setFrom('phonesell7896@gmail.com', "phonesell.com"); // sender's email and name
    $mail->addAddress($email, "phonesell.com");  // receiver's email and name

    $mail->Subject = 'your conformation';
    $mail->Body    = 'your order has been placed';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) { // handle error.
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}


try {
    $mail->isSMTP(); // using SMTP protocol                                     
    $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
    $mail->SMTPAuth = true;  // enable smtp authentication                             
    $mail->Username = 'phonesell7896@gmail.com';  // sender gmail host              
    $mail->Password = 'wpeolucbkvtfmljy'; // sender gmail host password                          
    $mail->SMTPSecure = 'tls';  // for encrypted connection                           
    $mail->Port = 587;   // port for SMTP     

    $mail->setFrom('phonesell7896@gmail.com', "phonesell.com"); // sender's email and name
    $mail->addAddress("balachzehr@hotmail.com", "phonesell.com");  // receiver's email and name

    $mail->Subject = 'NEW ORDER';
    $mail->Body    = 'may you have new order pls check it out';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) { // handle error.
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>
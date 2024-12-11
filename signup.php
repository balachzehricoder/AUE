

<?php 
session_start();
include 'admin/confiq.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Base files
require 'Email/PHPMailer/src/Exception.php';
require 'Email/PHPMailer/src/PHPMailer.php';
require 'Email/PHPMailer/src/SMTP.php';




// Registration Logic
if (isset($_POST["register"])) {
    // Get form inputs
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $cnic = trim($_POST["cnic"]);
    $dob = $_POST["dob"];
    $address = trim($_POST["address"]);
    $mobile_number = trim($_POST["mobile_number"]);
    $optional_mobile_number = trim($_POST["optional_mobile_number"]);
    $password = $_POST["password"];
    $sponsor_id = trim($_POST["sponsor_id"]);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }

    // Check if the email already exists
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists');</script>";
        exit();
    }

    // Password Hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle ID Card Front Image Upload
    $target_dir = "admin/uploads/id_card/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $id_card_picture = $target_dir . basename($_FILES["id_card_picture"]["name"]);
    move_uploaded_file($_FILES["id_card_picture"]["tmp_name"], $id_card_picture);

    // Handle Profile Picture Upload
    $profile_pic_target_dir = "admin/uploads/profile_pics/";
    if (!is_dir($profile_pic_target_dir)) {
        mkdir($profile_pic_target_dir, 0777, true);
    }
    $profile_pic = $profile_pic_target_dir . basename($_FILES["profile_pic"]["name"]);
    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profile_pic);

    // Generate Unique ID
    $unique_id = rand(10000, 999999);

    // Insert the User Data
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, cnic, dob, address, mobile_number, optional_mobile_number, password, id_card_picture, profile_pic, sponsor_id, unique_id, points, group_points) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0)");
    $stmt->bind_param("ssssssssssssi", $first_name, $last_name, $email, $cnic, $dob, $address, $mobile_number, $optional_mobile_number, $hashed_password, $id_card_picture, $profile_pic, $sponsor_id, $unique_id);

    if ($stmt->execute()) {
        // Update sponsor's group_points after registration
        if ($sponsor_id != "") {
            $update_sponsor = "UPDATE users SET group_points = group_points + 1 WHERE unique_id = '$sponsor_id'";
            mysqli_query($conn, $update_sponsor);
        }
        
        // Send the Unique ID and Email to User
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Use your SMTP server here
            $mail->SMTPAuth = true;
            $mail->Username = 'phonesell7896@gmail.com';  // Mailtrap username or SMTP username
            $mail->Password = 'wpeolucbkvtfmljy';  // Mailtrap password or SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('phonesell7896@gmail.com', 'AUE');
            $mail->addAddress($email, $first_name . ' ' . $last_name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to Our Platform';
            $mail->Body    = "Dear $first_name $last_name,<br><br>Your registration was successful. Your unique ID is: <b>$unique_id</b>.<br>Thank you for registering with us.<br><br>Best regards,<br>AUE";

            // Send email
            $mail->send();

            echo "<script>alert('Registration successful. A confirmation email has been sent to you.');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Registration successful, but we encountered an error while sending the email.');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        }

    } else {
        echo "<script>alert('Registration failed: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Tailwind configurations */
        .form-input:hover {
            border-color: #4CAF50;
        }
        .form-button {
            transition: all 0.3s ease;
        }
        .form-button:hover {
            background-color: #28a745;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-full">

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md bg-white p-8 rounded-xl shadow-lg">
    <img class="mx-auto h-12 w-auto" src="assets/logo.jpg" height="200px" alt="Company Logo">
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create Your Account</h2>
  </div>

  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md bg-white p-8 rounded-xl shadow-lg">
    <form class="space-y-6" action="" method="POST" enctype="multipart/form-data">
      <!-- First Name -->
      <div>
        <label for="first_name" class="block text-lg font-semibold text-gray-900">First Name</label>
        <input type="text" name="first_name" id="first_name" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- Last Name -->
      <div>
        <label for="last_name" class="block text-lg font-semibold text-gray-900">Last Name</label>
        <input type="text" name="last_name" id="last_name" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-lg font-semibold text-gray-900">Email Address</label>
        <input type="email" name="email" id="email" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- CNIC -->
      <div>
        <label for="cnic" class="block text-lg font-semibold text-gray-900">CNIC</label>
        <input type="text" name="cnic" id="cnic" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- Date of Birth -->
      <div>
        <label for="dob" class="block text-lg font-semibold text-gray-900">Date of Birth</label>
        <input type="date" name="dob" id="dob" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- Address -->
      <div>
        <label for="address" class="block text-lg font-semibold text-gray-900">Address</label>
        <textarea name="address" id="address" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300"></textarea>
      </div>

      <!-- Mobile Number -->
      <div>
        <label for="mobile_number" class="block text-lg font-semibold text-gray-900">Mobile Number</label>
        <input type="text" name="mobile_number" id="mobile_number" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- Optional Mobile Number -->
      <div>
        <label for="optional_mobile_number" class="block text-lg font-semibold text-gray-900">Optional Mobile Number</label>
        <input type="text" name="optional_mobile_number" id="optional_mobile_number" class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- ID Card Picture -->
      <div>
        <label for="id_card_picture" class="block text-lg font-semibold text-gray-900">ID Card Picture</label>
        <input type="file" name="id_card_picture" id="id_card_picture" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- Profile Picture -->
      <div>
        <label for="profile_pic" class="block text-lg font-semibold text-gray-900">Profile Picture</label>
        <input type="file" name="profile_pic" id="profile_pic" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- Sponsor ID -->
      <div>
        <label for="sponsor_id" class="block text-lg font-semibold text-gray-900">Sponsor ID (Optional)</label>
        <input type="text" name="sponsor_id" id="sponsor_id" class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-lg font-semibold text-gray-900">Password</label>
        <input type="password" name="password" id="password" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
      </div>

      <!-- Register Button -->
      <div>
        <button type="submit" name="register" class="form-button flex w-full justify-center rounded-md bg-indigo-600 px-4 py-3 text-lg font-semibold text-white shadow-md hover:shadow-xl focus:outline-none">Register</button>
      </div>

<p>Already Have an Account    <span style="color: blue;" ><a href="login.php">login</a></span></p>



    </form>
  </div>
</div>

</body>
</html>

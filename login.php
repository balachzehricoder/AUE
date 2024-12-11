<?php
session_start();
include 'admin/confiq.php';

if (isset($_POST["login"])) {
    $unique_id = $_POST["unique_id"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE unique_id = '$unique_id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('No user found with this ID');</script>";
        exit();
    }

    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Incorrect password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
        <div class="text-center">
        <img class="mx-auto h-12 w-auto" src="assets/logo.jpg" height="200px" alt="Company Logo">

            <h2 class="text-3xl font-extrabold text-gray-900">Login to Your Account</h2>
            <p class="mt-4 text-lg text-gray-600">Please enter your unique ID and password to log in.</p>
        </div>

        <!-- Login Form -->
        <form method="post" class="space-y-6 mt-8">
            <!-- Unique ID -->
            <div>
                <label for="unique_id" class="block text-lg font-semibold text-gray-900">Unique ID</label>
                <input type="text" name="unique_id" id="unique_id" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-lg font-semibold text-gray-900">Password</label>
                <input type="password" name="password" id="password" required class="form-input block w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300">
            </div>

            <!-- Login Button -->
            <div>
                <button type="submit" name="login" class="form-button flex w-full justify-center rounded-md bg-indigo-600 px-4 py-3 text-lg font-semibold text-white shadow-md hover:shadow-xl focus:outline-none">Login</button>
            </div>
            <p>Dont Have an Account    <span style="color: blue;" ><a href="signup.php.php">signup</a></span></p>

        </form>
    </div>

</body>

</html>

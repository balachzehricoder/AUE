<?php
// signup.php

include 'confiq.php'; // Include your database connection

// Initialize an empty message for feedback
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Image upload handling
    $image = $_FILES['profile_image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_size = $image['size'];
    $image_error = $image['error'];
    
    // Specify the directory where the image will be stored
    $target_dir = 'uploads/';
    $target_file = $target_dir . basename($image_name);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate input and image upload
    if (!in_array($role, ['Super Admin', 'Admin', 'Editor'])) {
        $message = 'Invalid role selected.';
    } elseif ($image_error !== 0) {
        $message = 'Error uploading the image.';
    } elseif (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        $message = 'Only JPG, JPEG, PNG & GIF files are allowed.';
    } elseif ($image_size > 2000000) { // Limit the size to 2MB
        $message = 'Image size should not exceed 2MB.';
    } else {
        // Move the uploaded file to the server
        if (move_uploaded_file($image_tmp_name, $target_file)) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Prepare the SQL statement with the image file path
            $sql = "INSERT INTO admins (username, email, password, role, profile_image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $username, $email, $hashed_password, $role, $target_file);

            // Execute the statement
            if ($stmt->execute()) {
                $message = 'Signup successful!';
            } else {
                $message = 'Error: ' . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            $message = 'Error moving the uploaded file.';
        }
    }

    // Close the connection
    $conn->close();
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <label for="username">Username:</label>
    <input type="text" class="form-control" id="username" name="username" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="role">Role:</label>
    <select id="role" name="role" required>
        <option value="Super Admin">Super Admin</option>
        <option value="Admin">Admin</option>
        <option value="Editor">Editor</option>
    </select><br><br>

    <!-- New image upload field -->
    <label for="profile_image">Profile Image:</label>
    <input type="file" id="profile_image" name="profile_image" accept="image/*" required><br><br>

    <input type="submit" value="Signup">
</form>

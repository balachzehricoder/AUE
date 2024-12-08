<?php
// Include database connection
include 'confiq.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $category_id = $_POST['category_id'];
    $product_tax = $_POST['product_tax'];
    $product_points = $_POST['product_points'];
    $product_bp = $_POST['product_bp'];

    // Handle image upload
    $upload_dir = "uploads/products/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $target_file = $upload_dir . basename($_FILES["product_image"]["name"]);
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate file type
    $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($image_file_type, $valid_extensions)) {
        die("Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    // Move the file
    if (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        die("Failed to upload image.");
    }

    // Insert data into the database
    $sql = "INSERT INTO products (p_name, p_price, p_qty, category_id, p_tax, points, bp, img_upload)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdiiidss", $product_name, $product_price, $product_quantity, $category_id, $product_tax, $product_points, $product_bp, $target_file);

    if ($stmt->execute()) {
header("Location: post.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php
include 'confiq.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = intval($_POST['product_id']);
    $p_name = htmlspecialchars($_POST['p_name']);
    $p_price = floatval($_POST['p_price']);
    $bp = floatval($_POST['bp']);
    $p_qty = intval($_POST['p_qty']);
    $p_tax = floatval($_POST['p_tax']);
    $points = floatval($_POST['points']);
    $category_id = intval($_POST['category_id']);

    // Image upload handling
    $upload_dir = "uploads/products/";
    $img_upload = $_POST['old_img_upload']; // Default to the old image

    if (!empty($_FILES['img_upload']['name'])) {
        // Sanitize file name
        $file_name = basename($_FILES['img_upload']['name']);
        $file_name = preg_replace("/[^a-zA-Z0-9.-]/", "_", $file_name); // Replace special characters

        $target = $upload_dir . $file_name;

        // Ensure the directory exists
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES['img_upload']['tmp_name'], $target)) {
            $img_upload = $target; // Save the full path
        } else {
            echo "Error uploading file.";
            exit;
        }
    }

    // Prepare the SQL query
    if (!empty($img_upload)) {
        $stmt = $conn->prepare("
            UPDATE products 
            SET p_name = ?, p_price = ?, bp = ?, p_qty = ?, p_tax = ?, points = ?, category_id = ?, img_upload = ? 
            WHERE id = ?
        ");
        $stmt->bind_param("ssdiisssi", $p_name, $p_price, $bp, $p_qty, $p_tax, $points, $category_id, $img_upload, $product_id);
    } else {
        $stmt = $conn->prepare("
            UPDATE products 
            SET p_name = ?, p_price = ?, bp = ?, p_qty = ?, p_tax = ?, points = ?, category_id = ? 
            WHERE id = ?
        ");
        $stmt->bind_param("ssdiissi", $p_name, $p_price, $bp, $p_qty, $p_tax, $points, $category_id, $product_id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: post.php");
    } else {
        echo "Error updating product: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

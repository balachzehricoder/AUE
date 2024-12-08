<?php
include 'confiq.php'; // Your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    // Insert category into the database
    $query = "INSERT INTO categories (name, description) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $category_name, $category_description);
    $stmt->execute();
    $stmt->close();

    // Redirect to categories page after adding
    header("Location: catigory.php");
    exit();
}
?>

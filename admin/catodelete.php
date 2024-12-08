<?php
include 'confiq.php';

$category_id = $_GET['id'] ?? null;

if ($category_id) {
    // Delete category from the database
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $stmt->close();

    header('Location: catigory.php');
}

$conn->close();
?>

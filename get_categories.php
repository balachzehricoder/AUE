<?php
include 'admin/confiq.php';  // Database connection

// Fetch all distinct categories from the products table
$query = "SELECT *  FROM categories";
$result = $conn->query($query);

// Check if categories exist and return them
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</option>";
    }
} else {
    echo "<option value=''>No categories found</option>";
}
?>

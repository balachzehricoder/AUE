<?php
include 'confiq.php';
include 'header.php';
include 'sidebar.php';
$category_id = $_GET['id'] ?? null;

if ($category_id) {
    $stmt = $conn->prepare("SELECT id, name, description FROM categories WHERE id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $category_result = $stmt->get_result();
    $category = $category_result->fetch_assoc();
    $stmt->close();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle form submission to update category
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Update the category without the picture field
        $stmt = $conn->prepare("UPDATE categories SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $description, $category_id);
        $stmt->execute();
        $stmt->close();

        header('Location: catigory.php'); // Redirect to categories page
    }
}
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Category</h4>
                        <form method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($category['description']); ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$conn->close();
include 'footer.php';
?>

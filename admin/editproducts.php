<?php
include 'confiq.php';
include 'header.php';
include 'sidebar.php';

// Fetch product ID from query parameter
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;

if ($product_id) {
    // Fetch product details from the database
    $stmt = $conn->prepare("SELECT id, p_name, p_price, p_qty, p_tax, bp, points, img_upload, category_id, created_at FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product_result = $stmt->get_result();
    $product = $product_result->fetch_assoc();
    $stmt->close();
}

// Fetch categories for dropdown
$category_query = "SELECT id, name FROM categories";
$category_result = $conn->query($category_query);
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Product</h4>
                        <form action="editpconfig.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                            <div class="form-group">
                                <label for="p_name">Product Name</label>
                                <input type="text" name="p_name" id="p_name" class="form-control" value="<?= htmlspecialchars($product['p_name']) ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="p_price">Price</label>
                                <input type="text" name="p_price" id="p_price" class="form-control" value="<?= htmlspecialchars($product['p_price']) ?>" required>
                            </div>

                            <!-- <div class="form-group">
                                <label for="bp">Best Price</label>
                                 <input type="text" name="bp" id="bp" class="form-control" value="" required> -->
                            <!-- </div>  -->

                            <div class="form-group">
                                <label for="p_qty">Quantity</label>
                                <input type="number" name="p_qty" id="p_qty" class="form-control" value="<?= htmlspecialchars($product['p_qty']) ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="p_tax">Tax (%)</label>
                                <input type="text" name="p_tax" id="p_tax" class="form-control" value="<?= htmlspecialchars($product['p_tax']) ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="points">Points</label>
                                <input type="text" name="points" id="points" class="form-control" value="<?= htmlspecialchars($product['points']) ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <?php while ($category = $category_result->fetch_assoc()): ?>
                                        <option value="<?= $category['id'] ?>" <?= ($category['id'] == $product['category_id']) ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="img_upload">Product Image</label>
                                <input type="file" name="img_upload" id="img_upload" class="form-control">
                                <img src="uploads/<?= htmlspecialchars($product['img_upload']) ?>" alt="Product Image" width="100" height="100">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update Product</button>
                            </div>
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


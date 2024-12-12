<?php
include 'confiq.php';
include 'header.php';
include 'sidebar.php';
?>

<?php
// Fetch all categories for filtering
$category_query = "SELECT id, name FROM categories";
$category_result = $conn->query($category_query);

// Handle category filter
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

// Fetch products based on selected category
if ($category_id) {
    $stmt = $conn->prepare("SELECT id, p_name, p_price, p_qty, p_tax, img_upload, points, category_id, bp, created_at FROM products WHERE category_id = ? ORDER BY p_name ASC");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $product_result = $stmt->get_result();
    $stmt->close();
} else {
    $product_query = "SELECT id, p_name, p_price, p_qty, p_tax, img_upload, points, category_id, bp, created_at FROM products ORDER BY p_name ASC";
    $product_result = $conn->query($product_query);
}
?>

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Products</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">All Products</h4>
                            <button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#add-new-product">
                                <i class="fa fa-plus-circle"></i> Add New Product
                            </button>
                        </div>

                        <!-- Category Filter -->


                        <!-- Product Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Tax</th>
                                    <th>Points</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($product_result->num_rows > 0) {
                                    while ($product = $product_result->fetch_assoc()) {
                                        // Fetch the category name for each product
                                        $category_stmt = $conn->prepare("SELECT name FROM categories WHERE id = ?");
                                        $category_stmt->bind_param("i", $product['category_id']);
                                        $category_stmt->execute();
                                        $category_result = $category_stmt->get_result();
                                        $category_name = $category_result->fetch_assoc()['name'];
                                        $category_stmt->close();

                                        // Format the created_at field
                                        $created_at = date("Y-m-d H:i:s", strtotime($product['created_at']));

                                        echo "<tr>
                                                    <td>" . htmlspecialchars($product['p_name']) . "</td>
                                                    <td>" . htmlspecialchars($product['p_price']) . "</td>
                                                    <td>" . htmlspecialchars($product['p_qty']) . "</td>
                                                    <td>" . htmlspecialchars($product['p_tax']) . "%</td>
                                                    <td>" . htmlspecialchars($product['points']) . "</td>
                                                    <td><img src='" . htmlspecialchars($product['img_upload']) . "' alt='Product Image' style='width:50px;height:50px;'></td>
                                                    <td>" . htmlspecialchars($category_name) . "</td>
                                                    <td>" . $created_at . "</td>
                                                    <td>
                                                        <div class='updated_btns'>
                                                            <a href='editproducts.php?product_id=" . urlencode($product['id']) . "' class='text-white btn mb-0 px-3 py-0 btn-flat btn-success' style='font-size:10px;'>Edit</a>
                                                            <a href='deletep.php?product_id=" . urlencode($product['id']) . "' class='text-white btn mb-0 px-3 py-0 btn-flat btn-danger' style='font-size:10px;'>Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='10'>No products found</td></tr>";
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Tax</th>
                                    <th>Points</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$conn->close();
?>



<!--**********************************
            Content body end
        ***********************************-->
<div class="modal fade" id="add-new-product">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="addproduct.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label for="product-name" class="col-form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="product-name" name="product_name" placeholder="Enter product name..." required>

                                <label for="product-price" class="col-form-label">Product Price <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="product-price" name="product_price" placeholder="Enter product price..." required>

                                <label for="product-quantity" class="col-form-label">Product Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="product-quantity" name="product_quantity" placeholder="Enter product quantity..." required>

                                <label for="product-category" class="col-form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-control" id="product-category" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    // Include your database connection
                                    include 'confiq.php'; // Replace with your database connection script

                                    // Fetch categories from the database
                                    $query = "SELECT id, name FROM categories";
                                    $result = $conn->query($query);

                                    // Populate dropdown with category names
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No categories available</option>";
                                    }
                                    ?>
                                </select>

                                <label for="product-tax" class="col-form-label">Tax (%) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" id="product-tax" name="product_tax" placeholder="Enter product tax..." required>

                                <label for="product-points" class="col-form-label">Points <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="product-points" name="product_points" placeholder="Enter product points..." required>

                                <!-- <label for="product-bp" class="col-form-label">BP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="product-bp" name="product_bp" placeholder="Enter BP value..." required> -->

                                <label for="product-image" class="col-form-label">Product Image <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="product-image" name="product_image" required>
                                        <label class="custom-file-label" for="product-image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Publish Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>

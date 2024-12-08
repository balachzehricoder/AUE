<?php
include 'confiq.php';
include 'header.php';
include 'sidebar.php';
// Fetch categories from the database
$category_query = "SELECT id, name, description,  created_at FROM categories ORDER BY created_at DESC";
$category_result = $conn->query($category_query);

?>

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">All Categories</h4>
                                <button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#add-edit-category">
                                    <i class="fa fa-plus-circle"></i> Add New Category
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($category_result->num_rows > 0) {
                                        while ($category = $category_result->fetch_assoc()) {
                                            $created_at = date("Y-m-d H:i:s", strtotime($category['created_at']));
                                            echo "<tr>
                                                    <td>" . htmlspecialchars($category['name']) . "</td>
                                                    <td>" . htmlspecialchars($category['description']) . "</td>
                                                    <td>" . $created_at . "</td>
                                                    <td>
                                                        <div class='updated_btns'>
                                                            <a href='editcato.php?id=" . urlencode($category['id']) . "' class='text-white btn mb-0 px-3 py-0 btn-flat btn-success' style='font-size:10px;'>Edit</a>
                                                            <a href='catodelete.php?id=" . urlencode($category['id']) . "' class='text-white btn mb-0 px-3 py-0 btn-flat btn-danger' style='font-size:10px;'>Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No categories found</td></tr>";
                                    }
                                    ?>
                                    </tbody>
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
include 'footer.php';
?>

<!-- Modal for Add/Edit Category -->
<div class="modal fade" id="add-edit-category">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form id="category-form" action="addcato.php" method="post">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label for="category-name" class="col-form-label">Category Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="category-name" name="category_name" placeholder="Enter category name..." required>

                                <label for="category-description" class="col-form-label">Category Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="category-description" name="category_description" placeholder="Enter category description..." required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary" id="submit-btn">Publish Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




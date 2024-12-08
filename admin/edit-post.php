<?php 
include 'confiq.php';
include 'header.php';
include 'sidebar.php';

$post_id = $_GET['post_id'] ?? null;
$post_data = null;

// Fetch the existing data if post_id is provided
if ($post_id) {
    $query = "SELECT * FROM posts WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post_data = $result->fetch_assoc();
}
?>
        
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="basic-form w-100">
                <form action="edit-post-config.php" method="post" enctype="multipart/form-data">
                    <!-- Include the post ID in the form -->
                    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_data['id'] ?? ''); ?>">
                    <input type="hidden" name="existing-thumbnail" value="<?php echo htmlspecialchars($post_data['thumbnail'] ?? ''); ?>">

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label class="col-form-label" for="post-title">Post Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="post-title" name="post-title" 
                            value="<?php echo htmlspecialchars($post_data['title'] ?? ''); ?>" placeholder="Enter a post title.." required>
                            <label class="col-form-label" for="post-title">Post sub_title <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" id="post-title" name="sub_title" 
                            value="<?php echo htmlspecialchars($post_data['sub_title'] ?? ''); ?>" placeholder="Enter a post sub_title.." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label class="col-form-label" for="post-description">Post Description <span class="text-danger">*</span></label>
                            <textarea class="form-control summernote" id="post-description" name="post-description" placeholder="Enter post description.." required><?php echo htmlspecialchars($post_data['description'] ?? ''); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="col-form-label" for="post-author">Post Author<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="post-author" name="post-author" 
                            value="<?php echo htmlspecialchars($post_data['author'] ?? ''); ?>" placeholder="Author name.." required>
                        </div>

                        <div class="col-lg-6">
    <label class="col-form-label" for="post-category">Post Category<span class="text-danger">*</span></label>
    <select class="form-control" id="post-category" name="post-category" required>
        <option value="">Select Post Category</option>
        <?php
        // Fetch categories dynamically from the database
        $category_query = "SELECT id, category_name FROM categories";
        $category_result = $conn->query($category_query);

        if ($category_result && $category_result->num_rows > 0) {
            while ($category = $category_result->fetch_assoc()) {
                $selected = ($post_data['category'] == $category['id']) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($category['id']) . "' " . $selected . ">" . htmlspecialchars($category['category_name']) . "</option>";
            }
        } else {
            echo "<option value=''>No categories available</option>";
        }
        ?>
    </select>
</div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label class="col-form-label" for="post-thumbnail">Post Thumbnail<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="post-thumbnail" name="post-thumbnail">
                                    <label class="custom-file-label" for="post-thumbnail">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label for="post-tags">Tags</label><br>
                            <input type="checkbox" name="tags[]" value="post" <?php echo (strpos($post_data['tags'] ?? '', 'post') !== false) ? 'checked' : ''; ?>> #post
                            <input type="checkbox" name="tags[]" value="follow" <?php echo (strpos($post_data['tags'] ?? '', 'follow') !== false) ? 'checked' : ''; ?>> #follow
                            <!-- Add more checkboxes similarly -->
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-8 ml-auto">
                            <button type="submit" class="btn btn-primary">Update Post</button>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div> 

<?php
include 'footer.php'; 
?>

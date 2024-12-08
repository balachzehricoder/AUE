
<div class="modal fade" id="add-new-post">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Post</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form action="table-datatable-config.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="col-form-label" for="post-title">Post Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="post-title" name="post-title" placeholder="Enter a post title.." required>
                                <label class="col-form-label" for="post-title">Post sub tital<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="post-title" name="sub_title" placeholder="Enter a post sub title.." required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="col-form-label" for="post-description">Post Description <span class="text-danger">*</span></label>
                                <textarea class="form-control summernote" id="post-description" name="post-description" placeholder="Enter post description.." required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label" for="post-author">Post Author<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="post-author" name="post-author" placeholder="Author name.." required>
                            </div>

                            <div class="col-lg-6">
    <label class="col-form-label" for="post-category">Post Category<span class="text-danger">*</span></label>
    <select class="form-control" id="post-category" name="post-category" required>
        <option value="">Select Post Category</option>
        <?php
        include 'confiq.php';
        // Fetch categories from the database
        $category_query_modal = "SELECT id, category_name FROM categories";
        $category_result_modal = $conn->query($category_query_modal);

        if ($category_result_modal && $category_result_modal->num_rows > 0) {
            while ($category = $category_result_modal->fetch_assoc()) {
                echo "<option value='" . htmlspecialchars($category['id']) . "'>" . htmlspecialchars($category['category_name']) . "</option>";
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
                                        <input type="file" class="custom-file-input" id="post-thumbnail" name="post-thumbnail" required>
                                        <label class="custom-file-label" for="post-thumbnail">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label for="post-tags">Tags</label><br>
                                <input type="checkbox" name="tags[]" value="post"> #post
                                <input type="checkbox" name="tags[]" value="follow"> #follow
                                <input type="checkbox" name="tags[]" value="likeforlikes"> #likeforlikes
                                <input type="checkbox" name="tags[]" value="newpost"> #newpost
                                <input type="checkbox" name="tags[]" value="trending"> #trending
                                <input type="checkbox" name="tags[]" value="explore"> #explore
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Publish Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

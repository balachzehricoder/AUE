<?php
include 'confiq.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $post_title = $_POST['post-title'];
    $post_description = $_POST['post-description'];
    $post_author = $_POST['post-author'];
    $post_category = $_POST['post-category']; // This should be the category_id (integer)
    $tags = isset($_POST['tags']) ? implode(',', $_POST['tags']) : '';
    $sub_title = $_POST['sub_title'];

    // Fetch the current post details to check for the existing thumbnail
    $query = "SELECT thumbnail FROM posts WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post_data = $result->fetch_assoc();

    // Initialize $thumbnail_folder
    $thumbnail_folder = $post_data['thumbnail'] ?? '';

    // Handling file upload for thumbnail
    if (isset($_FILES['post-thumbnail']) && $_FILES['post-thumbnail']['error'] == UPLOAD_ERR_OK) {
        // New thumbnail uploaded
        $thumbnail_name = $_FILES['post-thumbnail']['name'];
        $thumbnail_tmp_name = $_FILES['post-thumbnail']['tmp_name'];
        $thumbnail_folder = 'uploads/' . basename($thumbnail_name); // Use basename for security
        move_uploaded_file($thumbnail_tmp_name, $thumbnail_folder);

        // Delete the old thumbnail if it exists and a new one is uploaded
        if (!empty($post_data['thumbnail']) && file_exists($post_data['thumbnail']) && $post_data['thumbnail'] !== $thumbnail_folder) {
            unlink($post_data['thumbnail']);
        }
    }

    // Update the post data (use category_id instead of category)
    $query = "UPDATE posts SET title = ?, description = ?, author = ?, category_id = ?, tags = ?, thumbnail = ?, sub_title = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $post_title, $post_description, $post_author, $post_category, $tags, $thumbnail_folder, $sub_title, $post_id);

    if ($stmt->execute()) {
        // Redirect to a success page or the post list page
        header("Location: post.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}
?>

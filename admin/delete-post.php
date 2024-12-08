<?php
include 'confiq.php';

// Check if post_id is set in the URL and is a valid integer
if (isset($_GET['post_id']) && !empty($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']);

    // Retrieve existing thumbnail for deletion
    $query = "SELECT thumbnail FROM posts WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $thumbnail_path = $row['thumbnail'];

        // Delete the post
        $query = "DELETE FROM posts WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $post_id);

        if ($stmt->execute()) {
            // Delete the thumbnail file from the server
            if ($thumbnail_path && file_exists($thumbnail_path)) {
                unlink($thumbnail_path);
            }

            // Redirect to the post list page
            header("Location: post.php");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
    } else {
        echo "Post not found.";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>

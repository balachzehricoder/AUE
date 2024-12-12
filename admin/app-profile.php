<?php 
include 'confiq.php'; 
include 'header.php';
include 'sidebar.php';

session_start(); // Start the session

// Assuming you fetch the logged-in user's details from the database
$user_id = $_SESSION['admin_username'];
$query = "SELECT ADMIN_NAME, ADMIN_EMAILID FROM admin WHERE ADMINid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        // Update the password in the database
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $update_query = "UPDATE admin SET ADMIN_PASSWORD = ? WHERE ADMINid = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param('si', $hashed_password, $user_id);
        if ($update_stmt->execute()) {
            echo "<script>alert('Password updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match.');</script>";
    }
}
?>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center mb-4">
                            <img class="mr-3" src="images/avatar/default.png" width="80" height="80" alt="Profile Picture">
                            <div class="media-body">
                                <h3 class="mb-0"><?php echo htmlspecialchars($user['ADMIN_NAME']); ?></h3>
                                <p class="text-muted mb-0"><?php echo htmlspecialchars($user['ADMIN_EMAILID']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>

            <div class="col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <h4>Change Password</h4>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
    Content body end
***********************************-->

<?php 
include 'footer.php'; 
?>
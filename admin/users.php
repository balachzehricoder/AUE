<?php
include 'confiq.php';
 include 'header.php';
 include 'sidebar.php';
?>

<?php
// Handle role filter
$role = isset($_GET['role']) ? $_GET['role'] : null;

// Fetch users based on selected role
if ($role) {
    $stmt = $conn->prepare("SELECT id, full_name, email, phone, address, role, referral_id, sponsor_id, personal_points, group_points, points FROM users WHERE role = ? ORDER BY full_name ASC");
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $user_result = $stmt->get_result();
    $stmt->close();
} else {
    $user_query = "SELECT id, full_name, email, phone, address, role, referral_id, sponsor_id, personal_points, group_points, points  FROM users ORDER BY full_name ASC";
    $user_result = $conn->query($user_query);
}
?>

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Users</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">All Users</h4>
                            <button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#add-new-user">
                                <i class="fa fa-plus-circle"></i> Add New User
                            </button>
                        </div>

                        <!-- Role Filter -->
                        <form method="get" action="">
                            <label for="role">Filter by Role:</label>
                            <select name="role" id="role">
                                <option value="">All Roles</option>
                                <option value="admin" <?php echo ($role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                <option value="user" <?php echo ($role == 'user' ? 'selected' : ''); ?>>User</option>
                                <!-- Add more roles as needed -->
                            </select>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>

                        <!-- User Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Referral ID</th>
                                    <th>Sponsor ID</th>
                                    <th>Personal Points</th>
                                    <th>Group Points</th>
                                    <th>Total Points</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($user_result->num_rows > 0) {
                                    while ($user = $user_result->fetch_assoc()) {
                                        // Format the created_at field

                                        echo "<tr>
                                                    <td>" . htmlspecialchars($user['full_name']) . "</td>
                                                    <td>" . htmlspecialchars($user['email']) . "</td>
                                                    <td>" . htmlspecialchars($user['phone']) . "</td>
                                                    <td>" . htmlspecialchars($user['address']) . "</td>
                                                    <td>" . htmlspecialchars($user['role']) . "</td>
                                                    <td>" . htmlspecialchars($user['referral_id']) . "</td>
                                                    <td>" . htmlspecialchars($user['sponsor_id']) . "</td>
                                                    <td>" . htmlspecialchars($user['personal_points']) . "</td>
                                                    <td>" . htmlspecialchars($user['group_points']) . "</td>
                                                    <td>" . htmlspecialchars($user['points']) . "</td>
                                                    
                                                </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='12'>No users found</td></tr>";
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Referral ID</th>
                                    <th>Sponsor ID</th>
                                    <th>Personal Points</th>
                                    <th>Group Points</th>
                                    <th>Total Points</th>
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
include 'footer.php';
?>

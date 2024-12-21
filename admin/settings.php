<?php
include 'confiq.php';
include 'header.php';
include 'sidebar.php';

// Check if the admin wants to toggle the button state
if (isset($_POST['toggle_button'])) {
    // Toggle the button state (0 = enabled, 1 = disabled)
    $new_state = $_POST['current_state'] == 0 ? 1 : 0;
    $stmt = $conn->prepare("UPDATE button_state SET is_disabled = ? WHERE button_name = ?");
    $stmt->bind_param("is", $new_state, $button_name);
    $button_name = "login_button";  // Button name you are toggling
    $stmt->execute();
    $stmt->close();
}

// Fetch the current state of the login button
$result = $conn->query("SELECT is_disabled FROM button_state WHERE button_name = 'login_button'");
$row = $result->fetch_assoc();
$current_state = $row['is_disabled'] ?? 0; // Default to 0 (enabled) if no state found

?>

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Orders</a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
    <div id="accordion">
<!-- Form for toggling login button state -->
<div class="container">
    <center>
    <form method="POST" action="">
        <label for="login_button_state">Login Button State:</label><br><br>
        <button type="submit" name="toggle_button" class="btn btn-primary">
            <?php echo $current_state == 1 ? 'Enable Login Button' : 'Disable Login Button'; ?>
        </button>
        <input type="hidden" name="current_state" value="<?php echo $current_state; ?>">
    </form>
    </center>
    
    <!-- Display current status -->
    <div class="status-message">
        <p>The login button is currently <?php echo $current_state == 1 ? 'disabled' : 'enabled'; ?>.</p>
    </div>
</div>
    </div></div></div>
<?php 
include 'footer.php';
?>

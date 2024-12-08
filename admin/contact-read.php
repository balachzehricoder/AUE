<?php 
include 'confiq.php'; 
include 'header.php';
include 'sidebar.php';

// Get the id from the URL
if (isset($_GET['id'])) {
    $contact_id = $_GET['id'];

    // Fetch contact details from the database
    $sql = "SELECT first_name, last_name, phone_number, email, message, created_at FROM contact_form WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $contact_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found";
        exit;
    }
} else {
    echo "No ID provided";
    exit;
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="email-right-box ml-0">
                            <div class="read-content">
                                <div class="media pt-5">
                                    <!-- <img class="mr-3 rounded-circle" src="images/avatar/1.jpg"> -->
                                    <div class="media-body">
                                        <h5 class="m-b-3"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h5>
                                        <p class="m-b-2"><?php echo date('d M Y', strtotime($row['created_at'])); ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="media mb-4 mt-1">
                                    <div class="media-body"><span class="float-right"><?php echo date('g:i A', strtotime($row['created_at'])); ?></span>
                                        <h4 class="m-0 text-primary">Message from <?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h4>
                                        <small class="text-muted">To: <?php echo htmlspecialchars($row['email']); ?></small>
                                    </div>
                                </div>
                                <h5 class="m-b-15">Hi, <?php echo htmlspecialchars($row['first_name']); ?>,</h5>
                                <p><?php echo htmlspecialchars($row['message']); ?></p>

                                <div class="table-responsive my-3">
                                    <table class="table header-border">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 150px;">First Name</th>
                                                <th style="min-width: 150px;">Last Name</th>
                                                <th style="min-width: 150px;">Phone Number</th>
                                                <th style="min-width: 120px;">Email</th>
                                                <th style="min-width: 350px;">Custom Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                                <td><?php echo htmlspecialchars($row['message']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group p-t-15">
                                    <textarea class="w-100 p-20 l-border-1" name="" id="" cols="30" rows="5" placeholder="Reply to the message"></textarea>
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary w-md m-b-30" type="button">Send</button>
                            </div>
                        </div>
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

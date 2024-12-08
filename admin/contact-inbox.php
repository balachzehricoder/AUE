<?php 
include 'confiq.php'; 
include 'header.php';
include 'sidebar.php';

?>



<!--**********************************
    Content body start
***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Apps</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Email</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="email-left-box">
                            <div class="mail-list mt-4">
                                <a href="email-inbox.html" class="list-group-item border-0 text-primary p-r-0">
                                    <i class="fa fa-inbox font-18 align-middle mr-2"></i> 
                                    <b>Inbox</b> 
                                    <span class="badge badge-primary badge-sm float-right m-t-5">198</span> 
                                </a>
                                <!-- <a href="#" class="list-group-item border-0 p-r-0">
                                    <i class="fa fa-trash font-18 align-middle mr-2"></i>Trash
                                </a> -->

                                <form method="POST" action="delete-email.php"> <!-- Form for deleting emails -->




                                <button type="submit" class="list-group-item border-0 p-r-0" name="delete" ><i class="fa fa-trash font-18 align-middle mr-2"></i>trash</button>
                            </div>
                        </div>

                        <div class="email-right-box">
                                <div class="email-list m-t-15">
                                    <?php
                                    // Fetch data from the contact_form table
                                    $sql = "SELECT id, first_name, last_name, email, message, created_at FROM contact_form ORDER BY created_at DESC LIMIT 20";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {

                                                                                   

                                        
                                            $fullName = htmlspecialchars($row['first_name'] . ' ' . $row['last_name'], ENT_QUOTES, 'UTF-8');
                                            $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
                                            $messagePreview = htmlspecialchars(substr($row['message'], 0, 100), ENT_QUOTES, 'UTF-8'); // Shorten message for preview
                                            $time = htmlspecialchars(date("g:i a", strtotime($row['created_at'])), ENT_QUOTES, 'UTF-8');
                                            ?>
                                            <div class="message">
                                            <a href="contact-read.php?id=<?php echo $row['id']; ?>">

                                                <div class="col-mail col-mail-1">
                                                    <div class="email-checkbox">
                                                        <input type="checkbox" name="email_ids[]" value="<?php echo $row['id']; ?>"> <!-- Checkbox with email ID -->
                                                        <label class="toggle" for="chk<?php echo $row['id']; ?>"></label>
                                                    </div>
                                                    <span class="star-toggle ti-star"></span>
                                                </div>
                                                <div class="col-mail col-mail-2">
                                                    <div class="subject">
                                                        <strong><?php echo $fullName; ?></strong> - <?php echo $messagePreview; ?>
                                                    </div>
                                                    <div class="date"><?php echo $time; ?></div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo "<p>No emails found</p>";
                                    }
                                    ?>
                                </div>

                                <!-- Trash button -->
                               
                            </form>

                            <!-- panel -->
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-left">1 - 20 of <?php echo $result->num_rows; ?></div>
                                </div>
                                <div class="col-5">
                                    <div class="btn-group float-right">
                                        <button class="btn btn-gradient" type="button"><i class="fa fa-angle-left"></i>
                                        </button>
                                        <button class="btn btn-dark" type="button"><i class="fa fa-angle-right"></i>
                                        </button>
                                    </div>
                                </div>
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

<?php 
include 'confiq.php'; 
include 'header.php';
include 'sidebar.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the 'id' from the URL and sanitize it

    // Fetch data from the database using the ID
    $sql = "SELECT service_type, other_service, first_name, last_name, phone_number, email, car_year, car_make, car_model, vin, license_plate, documentation 
            FROM service_inquiries WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Bind the 'id' as an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Store data in variables
        $service_type = $row['service_type'];
        $other_service = $row['other_service'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone_number = $row['phone_number'];
        $email = $row['email'];
        $car_year = $row['car_year'];
        $car_make = $row['car_make'];
        $car_model = $row['car_model'];
        $vin = $row['vin'];
        $license_plate = $row['license_plate'];
        $documentation = $row['documentation'];
    } else {
        echo "No data found for this ID.";
    }
} else {
    echo "No ID provided in the URL.";
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">View Inquiry</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inquiry Details</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Service Type</th>
                                        <td><?php echo htmlspecialchars($service_type); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Other Service</th>
                                        <td><?php echo htmlspecialchars($other_service); ?></td>
                                    </tr>
                                    <tr>
                                        <th>First Name</th>
                                        <td><?php echo htmlspecialchars($first_name); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td><?php echo htmlspecialchars($last_name); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number</th>
                                        <td><?php echo htmlspecialchars($phone_number); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo htmlspecialchars($email); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Car Year</th>
                                        <td><?php echo htmlspecialchars($car_year); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Car Make</th>
                                        <td><?php echo htmlspecialchars($car_make); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Car Model</th>
                                        <td><?php echo htmlspecialchars($car_model); ?></td>
                                    </tr>
                                    <tr>
                                        <th>VIN</th>
                                        <td><?php echo htmlspecialchars($vin); ?></td>
                                    </tr>
                                    <tr>
                                        <th>License Plate</th>
                                        <td><?php echo htmlspecialchars($license_plate); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Documentation</th>
                                        <td><?php echo htmlspecialchars($documentation); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="service_inquiries.php" class="btn btn-primary">Back to Inquiries</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

<?php 
include 'footer.php'; 
?>

<?php
include 'confiq.php';
include 'header.php';
include 'sidebar.php';
?>

<?php
// Fetch all orders with product details and buyer information using JOIN
$order_query = "
    SELECT o.id AS order_id, o.user_id, o.total, o.delivery_charges, o.order_date_time, o.status, 
           od.product_id, od.price AS product_price, od.qty AS product_qty, p.p_name AS product_name
    FROM orders o
    JOIN order_details od ON o.id = od.order_id   -- Make sure 'id' is the correct column name in orders table
    JOIN products p ON od.product_id = p.id
    ORDER BY o.order_date_time DESC
";
$order_result = $conn->query($order_query);
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">All Orders with Product Details</h4>
                        </div>

                        <!-- Order Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Delivery Charges</th>
                                    <th>Order Date/Time</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($order_result->num_rows > 0) {
                                    while ($order = $order_result->fetch_assoc()) {
                                        // Format the order_date_time field
                                        $order_date_time = date("Y-m-d H:i:s", strtotime($order['order_date_time']));

                                        // Calculate total for the product (price * quantity)
                                        $product_total = $order['product_price'] * $order['product_qty'];
                                        $total_with_delivery = $product_total + $order['delivery_charges'];

                                        echo "<tr>
                                                    <td>" . htmlspecialchars($order['order_id']) . "</td>
                                                    <td>" . htmlspecialchars($order['user_id']) . "</td>
                                                    <td>" . htmlspecialchars($order['product_name']) . "</td>
                                                    <td>" . htmlspecialchars($order['product_price']) . "</td>
                                                    <td>" . htmlspecialchars($order['product_qty']) . "</td>
                                                    <td>" . $product_total . "</td>
                                                    <td>" . htmlspecialchars($order['delivery_charges']) . "</td>
                                                    <td>" . $order_date_time . "</td>
                                                    <td>" . htmlspecialchars($order['status']) . "</td>
                                                </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No orders found</td></tr>";
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Delivery Charges</th>
                                    <th>Order Date/Time</th>
                                    <th>Status</th>
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

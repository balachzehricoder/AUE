<?php
include 'confiq.php';
include 'header.php';
include 'sidebar.php';

// Fetch orders grouped by users
$order_query = "
    SELECT o.id AS order_id, o.user_id, o.total, o.delivery_charges, o.order_date_time, o.status, 
           od.product_id, od.price AS product_price, od.qty AS product_qty, 
           p.p_name AS product_name, p.img_upload AS product_image, 
           u.first_name AS user_name, u.last_name AS user_last_name, u.email AS user_email, 
           u.address AS user_address, u.mobile_number AS user_mobile, u.points AS user_points
    FROM orders o
    JOIN order_details od ON o.id = od.order_id
    JOIN products p ON od.product_id = p.id
    JOIN users u ON o.user_id = u.id
    ORDER BY u.first_name, u.last_name, o.order_date_time DESC
";
$order_result = $conn->query($order_query);

// Group orders by user
$orders_by_user = [];
while ($order = $order_result->fetch_assoc()) {
    $user_key = $order['user_id']; // Use user_id for unique grouping
    $orders_by_user[$user_key]['name'] = $order['user_name'] . ' ' . $order['user_last_name'];
    $orders_by_user[$user_key]['email'] = $order['user_email'];
    $orders_by_user[$user_key]['mobile'] = $order['user_mobile'];
    $orders_by_user[$user_key]['address'] = $order['user_address'];
    $orders_by_user[$user_key]['orders'][] = $order;
}
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
            <?php if (!empty($orders_by_user)): ?>
                <?php foreach ($orders_by_user as $user_id => $user_data): ?>
                    <div class="card">
                        <div class="card-header" id="heading<?= $user_id ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" 
                                        data-target="#collapse<?= $user_id ?>" 
                                        aria-expanded="true" aria-controls="collapse<?= $user_id ?>">
                                    <?= htmlspecialchars($user_data['name']) ?>
                                </button>
                            </h5>
                        </div>

                        <div id="collapse<?= $user_id ?>" 
                             class="collapse" 
                             aria-labelledby="heading<?= $user_id ?>" 
                             data-parent="#accordion">
                            <div class="card-body">
                                <h5>User Details</h5>
                                <p><strong>Name:</strong> <?= htmlspecialchars($user_data['name']) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($user_data['email']) ?></p>
                                <p><strong>Mobile:</strong> <?= htmlspecialchars($user_data['mobile']) ?></p>
                                <p><strong>Address:</strong> <?= htmlspecialchars($user_data['address']) ?></p>

                                <h5 class="mt-4">Order Details</h5>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Delivery Charges</th>
                                        <th>Order Date/Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($user_data['orders'] as $order): ?>
                                        <?php
                                        $product_total = $order['product_price'] * $order['product_qty'];
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                                            <td><?= htmlspecialchars($order['product_name']) ?></td>
                                            <td>
                                                <img src="<?= htmlspecialchars($order['product_image']) ?>" 
                                                     alt="<?= htmlspecialchars($order['product_name']) ?>" 
                                                     width="50" height="50">
                                            </td>
                                            <td><?= htmlspecialchars($order['product_price']) ?></td>
                                            <td><?= htmlspecialchars($order['product_qty']) ?></td>
                                            <td><?= $product_total ?></td>
                                            <td><?= htmlspecialchars($order['delivery_charges']) ?></td>
                                            <td><?= date("Y-m-d H:i:s", strtotime($order['order_date_time'])) ?></td>
                                            <td><?= htmlspecialchars($order['status']) ?></td>
                                            <td>
                                                <form method="POST" action="deleveryorder.php">
                                                    <input type="hidden" name="order_id" 
                                                           value="<?= htmlspecialchars($order['order_id']) ?>">
                                                    <input type="hidden" name="user_email" 
                                                           value="<?= htmlspecialchars($user_data['email']) ?>">
                                                    <button type="submit" class="btn btn-success">
                                                        Mark as Delivered
                                                    </button>
                                                </form>
                                                <td>
                                                    
    <button class="btn btn-primary" data-toggle="modal" data-target="#trackingModal<?= $order['order_id'] ?>">Add Tracking Number</button>
</td>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$conn->close();
include 'footer.php';
?>


<!-- Modal for Adding Tracking Number -->
<div class="modal fade" id="trackingModal<?= $order['order_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="trackingModalLabel<?= $order['order_id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trackingModalLabel<?= $order['order_id'] ?>">Add Tracking Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="update_tracking.php">
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['order_id']) ?>">
                    <input type="hidden" name="user_email" value="<?= htmlspecialchars($user_data['email']) ?>">
                    <div class="form-group">
                        <label for="tracking_number">Tracking Number</label>
                        <input type="text" name="tracking_number" class="form-control" id="tracking_number" placeholder="Enter Tracking Number" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Tracking Number</button>
                </form>
            </div>
        </div>
    </div>
</div>


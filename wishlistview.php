<?php
include 'navandside.php';

function getWishlistItemsForUserview($user_id) {
    include 'admin/confiq.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get wishlist items for a specific user, including product image
    $sql = "SELECT products.*, wishlist.wishlist_id AS wishlist_id
            FROM wishlist
            INNER JOIN products ON wishlist.product_id = products.id
            WHERE wishlist.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $wishlistItems = array();

    while ($row = $result->fetch_assoc()) {
        $wishlistItems[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $wishlistItems;
}

// The Session Use
include 'includes/config.php';
$id = $_SESSION["user_id"];
$query = "SELECT * FROM users where id='$id'";

// Replace '123' with the actual user ID
$user_id = $id;

$wishlistItems = getWishlistItemsForUserview($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto my-8">
    <h1 class="text-3xl font-semibold text-center mb-6">Your Wishlist</h1>
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full text-left text-sm text-gray-600">
            <thead class="bg-indigo-600 text-white">
            <tr>
                <th class="p-3">Product</th>
                <th class="p-3">Description</th>
                <th class="p-3">Price</th>
                <th class="p-3">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if (count($wishlistItems) > 0): ?>
                <?php foreach ($wishlistItems as $item): ?>
                    <tr class="border-t">
                        <td class="p-3">
                            <img src="admin/<?php echo $item['img_upload']; ?>" alt="Product Image" class="w-16 h-16 object-cover rounded-md">
                        </td>
                        <td class="p-3">
                            <div class="font-medium"><?php echo $item['p_name']; ?></div>
                            <div class="text-xs text-gray-500">Color: black, Material: metal</div>
                        </td>
                        <td class="p-3">Rp<?php echo number_format($item['p_price']); ?></td>
                        <td class="p-3">
                            <a href="delete-wishlist-item.php?id=<?php echo $item['wishlist_id']; ?>" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i> Remove
                            </a>
                            <br>
                            <a href="add-to-cart.php?id=<?php echo $item['wishlist_id']; ?>" class="text-green-600 hover:text-green-800 mt-2 inline-block">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="p-3 text-center text-red-500">Your wishlist is empty</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>

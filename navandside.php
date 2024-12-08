<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonesell</title>

    <!-- Include TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="stylesheet" href="includes/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100">

<?php
include 'admin/confiq.php';
include 'funcation.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function to get wishlist item count for a specific user
function getWishlistItemCountForUser($user_id)
{
    include 'admin/confiq.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT COUNT(*) AS wishlist_count FROM wishlist WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $wishlistCount = ($result->num_rows > 0) ? $result->fetch_assoc()['wishlist_count'] : 0;

    $stmt->close();
    $conn->close();
    return $wishlistCount;
}

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    exit("You need to log in to view this page.");
}

$user_id = $_SESSION["user_id"];
$wishlistCount = getWishlistItemCountForUser($user_id);
$cartCount = isset($_SESSION['cart_details']['cart_total_qty']) ? $_SESSION['cart_details']['cart_total_qty'] : 0;
?>

<section class="bg-indigo-600 text-white py-4">
    <div class="container mx-auto flex justify-between items-center flex-wrap">
        <div class="text-sm w-full sm:w-auto">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
        <div class="flex gap-4 w-full sm:w-auto mt-2 sm:mt-0 justify-center sm:justify-end">
            <a href="userpanel/pages/dashboard.html" class="hover:text-indigo-200">User Dashboard</a>
            <a href="wishlistview.php" class="hover:text-indigo-200">Wishlist (<?php echo $wishlistCount; ?>)</a>
            <a href="cart.php" class="hover:text-indigo-200">Cart (<?php echo $cartCount; ?>)</a>
            <a href="logout.php" class="hover:text-indigo-200">Logout</a>
        </div>
    </div>
</section>

<nav class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center p-4 flex-wrap">
        <div class="text-2xl font-semibold text-indigo-600">
            <!-- Logo -->
            <img src="assets/logo.jpg" height="80px" width="80px">
        </div>
        <ul class="flex gap-6 text-lg text-gray-800 w-full sm:w-auto justify-center sm:justify-start mt-4 sm:mt-0">
            <li><a href="index.php" class="hover:text-indigo-600">Home</a></li>
            <li><a href="shop.php" class="hover:text-indigo-600">Shop</a></li>
            <li><a href="about.php" class="hover:text-indigo-600">About</a></li>
            <li><a href="contact.php" class="hover:text-indigo-600">Contact</a></li>
        </ul>
        <div class="flex gap-4 items-center w-full sm:w-auto justify-center sm:justify-end mt-4 sm:mt-0">
            <form action="search.php" method="GET" class="flex w-full sm:w-auto">
                <input type="text" name="query" placeholder="Search products..."
                       class="p-2 border border-gray-300 rounded-l-md w-full sm:w-64">
                <button type="submit"
                        class="p-2 bg-indigo-600 text-white rounded-r-md hover:bg-indigo-700 w-full sm:w-auto">Search
                </button>
            </form>
        </div>
    </div>
</nav>

<script src="includes/script.js"></script>
</body>
</html>

<?php
include 'admin/confiq.php';

// Define the searchProducts function
function searchProducts($search_query)
{
    global $conn; // Use the existing database connection

    // Sanitize the search query to prevent SQL injection
    $search_query = "%" . $conn->real_escape_string($search_query) . "%";

    // SQL query to search products based on the product name
    $sql = "SELECT * FROM products WHERE p_name LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search_query);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all products into an array
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $stmt->close();
    return $products;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-gray-100">

<?php include 'navandside.php'; ?>

<!-- Main Content -->
<div class="container mx-auto py-12">
    <h4 class="text-3xl font-bold text-center mb-8">Search Results</h4>

    <?php
    // Check if the search query is set and not empty
    if (isset($_GET['query']) && !empty($_GET['query'])) {
        // Perform the search
        $search_query = $_GET['query'];
        $products = searchProducts($search_query);

        // Check if the products array is empty after search
        if (empty($products)) {
            echo '<div class="text-center text-red-500 text-lg">No products found for the search query: ' . htmlspecialchars($search_query) . '</div>';
        } else {
            // Loop through the products and display them in a grid
            echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">';
            foreach ($products as $product) {
                ?>
                <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <a href="full_page.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                        <img class="w-full h-48 object-cover rounded-lg mb-4" src="admin/<?php echo htmlspecialchars($product["img_upload"]); ?>" alt="<?php echo htmlspecialchars($product["p_name"]); ?>"/>
                    </a>
                    <h5 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($product["p_name"]); ?></h5>
                    <p class="text-lg text-gray-600 mb-4">Rs <?php echo number_format($product["p_price"]); ?></p>

                    <!-- Display BP and Points -->
                    <p class="text-md text-blue-500 mb-2">Bonus Points: <?php echo number_format($product["bp"]); ?></p>
                    <p class="text-md text-yellow-500 mb-4">Points: <?php echo number_format($product["points"]); ?></p>

                    <div class="flex justify-between">
                        <a class="text-red-500 hover:text-red-700" href="wishlist.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                            <i class="fa fa-heart"></i> Wishlist
                        </a>
                        <a class="text-green-500 hover:text-green-700" href="add-to-cart.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                            <i class="fa fa-shopping-cart"></i> Add to Cart
                        </a>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
        }
    } else {
        // If no search query is entered
        echo '<div class="text-center text-red-500 text-lg">Please enter a search query.</div>';
    }
    ?>

</div>

</body>
</html>

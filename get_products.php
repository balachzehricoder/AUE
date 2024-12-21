<?php

include 'admin/confiq.php';  // Include database connection

// Get the filters
$category = isset($_GET['category']) ? $_GET['category'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

// Build the base query
$query = "SELECT * FROM products";

// Apply category filter if set
if (!empty($category)) {
    $query .= " WHERE category_id = '$category'";  // Assuming 'category_id' is the column in your 'products' table
}

// Apply sorting if set
if (!empty($sort)) {
    if ($sort == 'price_asc') {
        $query .= " ORDER BY p_price ASC";
    } elseif ($sort == 'price_desc') {
        $query .= " ORDER BY p_price DESC";
    } elseif ($sort == 'popularity') {
        $query .= " ORDER BY popularity DESC";  // Assuming you have a popularity column
    } elseif ($sort == 'newest') {
        $query .= " ORDER BY created_at DESC";  // Assuming you have a created_at column
    }
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $p_name = $row['p_name'];
        $p_price = number_format($row['p_price'], 2);
        $points = $row['points'];
        $img_upload = $row['img_upload'];
        $product_id = $row['id'];

        // Display the product with Tailwind CSS styles
        echo "<div class='bg-white shadow-lg rounded-lg overflow-hidden transform transition-all hover:scale-105'>
                <img src='admin/{$img_upload}' alt='{$p_name}' class='w-full h-48 object-cover'>
                <div class='p-4'>
                    <h3 class='text-xl font-semibold text-gray-800'>{$p_name}</h3>
                    <p class='text-lg text-gray-600'>Price: Rs {$p_price}</p>
                    <p class='text-sm text-gray-500'>Points: {$points}</p>
                    <br>
                    <div class='flex justify-between mt-4'>
                        <a href='wishlist.php?id={$product_id}' 
                           class='text-sm bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-all'>
                            <i class='icon-heart'></i> Wishlist
                        </a>
                        <a href='add-to-cart.php?id={$product_id}' 
                           class='text-sm bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-all'>
                            <i class='icon-shopping-cart'></i> Add to Cart
                        </a>
                    </div>
                </div>
              </div>";
    }
} else {
    echo "<p class='text-center text-gray-600 mt-8'>No products found.</p>";
}
?>

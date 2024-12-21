<?php
// Connect to your database
include 'admin/confiq.php'; 
include 'navandside.php'; 


// Get the product ID from the URL
$product_id = isset($_GET['id']) ? $_GET['id'] : 1; // Default to product 1 if no ID is given

// Fetch product details from the database
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Check if the product exists
if (!$product) {
    echo "Product not found!";
    exit;
}

// Fetch product details
$product_name = $product['p_name'];
$product_price = $product['p_price'];
$product_qty = $product['p_qty'];
$product_tax = $product['p_tax'];
$product_points = $product['points'];
$product_bp = $product['bp'];
$product_image = $product['img_upload']; // Assuming this is the image path/URL
$product_category_id = $product['category_id'];
$product_created_at = $product['created_at'];
?>
<style>
	body { font-family: 'Rubik', sans-serif; }
	[x-cloak] { display: none; }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $product_name; ?> - Product Page</title>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Rubik', sans-serif; }
    [x-cloak] { display: none; }
  </style>
</head>
<body>
  <!-- Product Section -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="flex flex-col md:flex-row -mx-4">
      <!-- Product Image Section -->
      <div class="md:flex-1 px-4" x-data="{ image: 1 }" x-cloak>
        <div class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4">
          <div x-show="image === 1" class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
            <img src="admin/<?php echo $product_image; ?>" alt="Product Image" class="w-full h-full object-cover rounded-lg">
          </div>
        </div>
      </div>

      <!-- Product Details Section -->
      <div class="md:flex-1 px-4">
        <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl"><?php echo $product_name; ?></h2>
        
        <div class="flex items-center space-x-4 my-4">
          <div>
            <div class="rounded-lg bg-gray-100 flex py-2 px-3">
              <span class="text-indigo-400 mr-1 mt-1">Rs</span>
              <span class="font-bold text-indigo-600 text-3xl"><?php echo number_format($product_price,); ?></span>
            </div>
          </div>
          <div class="flex-1">
            <p class="text-green-500 text-xl font-semibold">Available Quantity: <?php echo $product_qty; ?> pcs</p>
            <p class="text-gray-400 text-sm">Tax Included: <?php echo $product_tax; ?>%</p>
          </div>
        </div>

        <p class="text-gray-500">Reward Points: <?php echo $product_points; ?> points</p>
        <p class="text-gray-500">Product Created On: <?php echo date("F j, Y", strtotime($product_created_at)); ?></p>

        <!-- Quantity Selection & Add to Cart Button -->
        

		<a href="add-to-cart.php?id=<?php echo $product_id; ?>" class="text-sm bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition-all">
                                    <i class="icon-shopping-cart"></i> Add to Cart
                                </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php include 'footer.php' ?>

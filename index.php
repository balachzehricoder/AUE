<?php include 'navandside.php'; ?>
<link rel="stylesheet" href="includes/style.css">
<!-- Hero Section -->
<section id="hero" class="relative bg-gray-900 text-white py-24 px-6 flex flex-col justify-center items-center text-center bg-cover bg-center" style="background-image: url('assets/banner.jpg');">
  <h4 class="text-lg font-semibold uppercase tracking-wide text-indigo-600">Trade-in-fair</h4>
  <h2 class="text-3xl sm:text-4xl text-black lg:text-5xl font-extrabold leading-tight mt-4">Super value deals</h2>
  <h1 class="text-4xl sm:text-5xl text-black lg:text-6xl font-extrabold leading-tight mt-4">On all Products</h1>
  <p class="mt-6 text-lg sm:text-xl text-black leading-relaxed max-w-2xl">Save more with coupons and up to 70% off!</p>
  <a href="shop.php" class="mt-8 px-8 py-3 text-lg text-white font-semibold text-gray-900 bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 transition-all">
    Shop Now
  </a>
</section>



        
<section id="feature" class="py-16 bg-gray-50">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
      
      <!-- Feature 1 -->
      <div class="text-center p-6 bg-white shadow-lg rounded-lg flex flex-col items-center justify-center">
        <img src="https://i.postimg.cc/PrN2Y6Cv/f1.png" alt="Free Shipping" class="w-16 h-16 mb-4">
        <h6 class="text-xl font-semibold text-gray-800">Free Shipping</h6>
      </div>

      <!-- Feature 2 -->
      <div class="text-center p-6 bg-white shadow-lg rounded-lg flex flex-col items-center justify-center">
        <img src="https://i.postimg.cc/qvycxW4q/f2.png" alt="Online Order" class="w-16 h-16 mb-4">
        <h6 class="text-xl font-semibold text-gray-800">Online Order</h6>
      </div>

      <!-- Feature 3 -->
      <div class="text-center p-6 bg-white shadow-lg rounded-lg flex flex-col items-center justify-center">
        <img src="https://i.postimg.cc/1Rdphyz4/f3.png" alt="Save Money" class="w-16 h-16 mb-4">
        <h6 class="text-xl font-semibold text-gray-800">Save Money</h6>
      </div>

      <!-- Feature 4 -->
      <div class="text-center p-6 bg-white shadow-lg rounded-lg flex flex-col items-center justify-center">
        <img src="https://i.postimg.cc/GpYc2JFZ/f4.png" alt="Promotions" class="w-16 h-16 mb-4">
        <h6 class="text-xl font-semibold text-gray-800">Promotions</h6>
      </div>

      <!-- Feature 5 -->
      <div class="text-center p-6 bg-white shadow-lg rounded-lg flex flex-col items-center justify-center">
        <img src="https://i.postimg.cc/4yFCwmv6/f5.png" alt="Happy Sell" class="w-16 h-16 mb-4">
        <h6 class="text-xl font-semibold text-gray-800">Happy Sell</h6>
      </div>

      <!-- Feature 6 -->
      <div class="text-center p-6 bg-white shadow-lg rounded-lg flex flex-col items-center justify-center">
        <img src="https://i.postimg.cc/gJN1knTC/f6.png" alt="F24/7 Support" class="w-16 h-16 mb-4">
        <h6 class="text-xl font-semibold text-gray-800">F24/7 Support</h6>
      </div>
      
    </div>
  </div>
</section>

<!-- Product Display Section -->
<div id="products" class="bg-white py-10">
    <div class="container mx-auto px-4">
        <h2 class="text-center text-3xl font-bold mb-8 text-gray-800">Our Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php
            include 'admin/confiq.php';  // Include database connection
            $query = "SELECT * FROM products LIMIT 12";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                foreach ($result as $row) {
                    $p_name = $row['p_name'];
                    $p_price = number_format($row['p_price'], 2);
                    $bp = $row['bp'];
                    $points = $row['points'];
                    $img_upload = $row['img_upload'];
                    $product_id = $row['id'];

                    $escaped_p_name = htmlspecialchars($p_name, ENT_QUOTES, 'UTF-8');
                    ?>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden transform transition-transform hover:scale-105">
                        <!-- Product Image -->
                        <a href="full_page.php?id=<?php echo $product_id; ?>" class="block">
                            <img src="admin/<?php echo $img_upload; ?>" alt="<?php echo $escaped_p_name; ?>" 
                                 class="w-full h-56 object-cover">
                        </a>
                        <!-- Product Details -->
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800 truncate"> <?php echo $escaped_p_name; ?> </h3>
                            <p class="text-primary text-gray-600 mt-2 font-medium">Rs <?php echo $p_price; ?></p>
                            <p class="text-sm text-gray-700 mt-1 mb-3"><strong>Points:</strong> <?php echo $points; ?></p>
                            <div class="flex justify-between items-center">
                                <!-- Wishlist Button -->
                                <a href="wishlist.php?id=<?php echo $product_id; ?>" 
                                   class="text-sm bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-all">
                                    <i class="icon-heart"></i> Wishlist
                                </a>
                                <!-- Add to Cart Button -->
                                <a href="add-to-cart.php?id=<?php echo $product_id; ?>" 
                                   class="text-sm bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-all">
                                    <i class="icon-shopping-cart"></i> Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center text-gray-600'>No products found.</p>";
            }
            ?>
        </div>
        <!-- Shop Now Button -->
        <div class="mt-12 text-center">
            <a href="shop.php" class="px-8 py-3 text-lg font-semibold text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 transition-all">
                Shop Now
            </a>
        </div>
    </div>
</div>

<hr>
<section id="banner" class="py-24 px-6 bg-cover bg-center bg-scroll text-white text-center relative" style="background-image: url('assets/scroll.jpg');">
  <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold mt-4">
    Up to <span class="text-indigo-600">70% off</span> - All Tshirts and Accessories
  </h2>
  <button class="mt-8 px-8 py-3 text-lg font-semibold text-gray-900 bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 transition-all">
    Explore more
  </button>
</section>

<section class="bg-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold mb-8 text-black ">What Our Clients Say</h2>
        <div class="flex justify-center space-x-8">
            <!-- Testimonial 1 -->
            <div class="bg-gray-100 p-8 rounded-lg shadow-lg max-w-xs">
                <p class="text-lg text-gray-700 mb-4">"This product completely exceeded my expectations! Excellent quality and fast delivery."</p>
                <p class="text-sm text-gray-500">- John Doe, CEO at Company</p>
            </div>
            <!-- Testimonial 2 -->
            <div class="bg-gray-100 p-8 rounded-lg shadow-lg max-w-xs">
                <p class="text-lg text-gray-700 mb-4">"I love the service! The team was incredibly helpful, and I will definitely be a return customer."</p>
                <p class="text-sm text-gray-500">- Sarah Lee, Marketing Manager</p>
            </div>
            <!-- Testimonial 3 -->
            <div class="bg-gray-100 p-8 rounded-lg shadow-lg max-w-xs">
                <p class="text-lg text-gray-700 mb-4">"Amazing experience! The website is easy to use, and the product quality is fantastic."</p>
                <p class="text-sm text-gray-500">- Michael Johnson, Entrepreneur</p>
            </div>
        </div>
    </div>
</section>


<hr>



<!-- Footer Section -->
<?php include 'footer.php'; ?>


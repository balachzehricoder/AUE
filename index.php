<!-- Include the navbar from navandside.php -->
<?php include 'navandside.php'; ?>

<style>
    .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-img-top img {
        object-fit: cover;
        height: 200px;
    }
</style>

<section id="home" class="relative bg-gray-50 py-16 lg:py-24">
    <div class="container mx-auto flex flex-col-reverse lg:flex-row items-center lg:gap-12">
        <!-- Text Content -->
        <div class="w-full lg:w-1/2 text-center lg:text-left">
            <p class="text-lg font-semibold text-indigo-600 uppercase tracking-wide">Summer Collection</p>
            <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-800 leading-tight mt-4">
                FALL - WINTER<br>Collection 2023
            </h1>
            <p class="mt-6 text-gray-600 text-lg leading-relaxed">
                A specialist label creating luxury essentials. Ethically crafted with<br>
                an unwavering commitment to exceptional quality.
            </p>
            <div class="mt-8 flex flex-col lg:flex-row gap-4">
                <a href="#sellers" class="inline-block px-8 py-3 text-lg font-medium text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700">
                    Shop Now
                </a>
                <a href="#learn-more" class="inline-block px-8 py-3 text-lg font-medium text-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-50">
                    Learn More
                </a>
            </div>
            <div class="mt-10 flex justify-center lg:justify-start gap-4">
                <a href="#" class="text-gray-500 hover:text-indigo-600 transition">
                    <i class='bx bxl-facebook text-2xl'></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-indigo-600 transition">
                    <i class='bx bxl-twitter text-2xl'></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-indigo-600 transition">
                    <i class='bx bxl-pinterest text-2xl'></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-indigo-600 transition">
                    <i class='bx bxl-instagram text-2xl'></i>
                </a>
            </div>
        </div>

        <!-- Image Content -->
        <div class="w-full lg:w-1/2">
            <img src="https://i.postimg.cc/t403yfn9/home2.jpg" alt="Fall Winter Collection 2023" class="rounded-lg shadow-lg object-cover w-full h-full max-h-[500px]">
        </div>
    </div>
</section>

<!-- Display the products for the selected category using Bootstrap cards -->
<div class="bg-white py-10">
    <div class="container mx-auto px-4">
        <h2 class="text-center text-2xl font-bold mb-6 text-gray-800">Our Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            $query = "SELECT * FROM products";
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
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <a href="full_page.php?id=<?php echo $product_id; ?>" class="block">
                            <img src="admin/<?php echo $img_upload; ?>" alt="<?php echo $escaped_p_name; ?>" class="w-full h-48 object-cover transition-transform transform hover:scale-105">
                        </a>
                        <div class="p-4 flex flex-col">
                            <h3 class="text-lg font-semibold text-gray-800 truncate"><?php echo $escaped_p_name; ?></h3>
                            <p class="text-primary font-medium text-gray-600 mb-2">Rs<?php echo $p_price; ?></p>
                            <p class="text-sm text-gray-700"><strong>BP:</strong> <?php echo $bp; ?></p>
                            <p class="text-sm text-gray-700 mb-3"><strong>Points:</strong> <?php echo $points; ?></p>
                            <div class="mt-auto flex justify-between">
                                <a href="wishlist.php?id=<?php echo $product_id; ?>" class="text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    <i class="icon-heart"></i> Wishlist
                                </a>
                                <a href="add-to-cart.php?id=<?php echo $product_id; ?>" class="text-sm bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                    <i class="icon-shopping-cart"></i> Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

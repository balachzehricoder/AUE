<?php
session_start();
include "admin/confiq.php";

// Example session check for a logged-in user
$isLoggedIn = isset($_SESSION['user_id']); // Check if a user session exists
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="assets/logo.jpg">
</head>
<body>
<nav class="bg-white text-black-50 sticky top-0 z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="index.php">
                <img src="assets/logo.jpg" alt="Logo" class="h-12">
            </a>

            <!-- Search Bar for All Devices -->
            <div class="flex items-center w-1/2">
                <form action="search.php" method="GET" class="w-full flex items-center">
                    <div class="relative w-full">
                        <input
                                type="text"
                                name="query"
                                class="w-full py-2 px-4 pl-10 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="Search products..."
                        />
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 18a7 7 0 100-14 7 7 0 000 14zm0 0l6 6" />
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Nav Links (Desktop) -->
            <div class="hidden md:flex space-x-6">
                <a href="index.php" class="hover:text-gray-700 text-black ">Home</a>
                <a href="shop.php" class="hover:text-gray-700 text-black">Shop</a>
                <a href="contactus.php" class="hover:text-gray-700 text-black">Contact Us</a>
            </div>

            <!-- Auth/User Links -->
            <div class="hidden md:flex items-center space-x-6">
                <?php if ($isLoggedIn): ?>
                    <!-- User is logged in -->
                    <a href="userpanel/pages/dashboard.php" class="hover:text-gray-700 text-black">Profile</a>
                    <a href="wishlistview.php" class="hover:text-gray-700 text-black">Wishlist</a>
                    <a href="cart.php" class="hover:text-gray-700 text-black">Cart</a>
                    <a href="logout.php" class="hover:text-gray-700 text-black">Logout</a>
                <?php else: ?>
                    <!-- User is not logged in -->
                    <a href="login.php" class="hover:text-gray-700 text-black">Sign In</a>
                    <a href="register.php" class="hover:text-gray-700 text-black">Sign Up</a>
                    <a href="cart.php" class="hover:text-gray-700 text-black">Cart</a>
                <?php endif; ?>
            </div>

            <!-- Burger Menu (Mobile) -->
            <div class="flex md:hidden">
                <button id="menu-button" class="text-black focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden">
            <a href="index.php" class="block py-2 px-4 text-sm hover:bg-gray-300 text-black">Home</a>
            <a href="shop.php" class="block py-2 px-4 text-sm hover:bg-gray-300 text-black">Shop</a>
            <a href="contact.php" class="block py-2 px-4 text-sm hover:bg-gray-300 text-black">Contact Us</a>
            <?php if ($isLoggedIn): ?>
                <!-- User is logged in -->
                <a href="userpanel/pages/dashboard.html" class="block py-2 px-4 text-sm hover:bg-gray-300 text-black">Profile</a>
                <a href="wishlist.php" class="block py-2 px-4 text-sm hover:bg-gray-300 text-black">Wishlist</a>
                <a href="cart.php" class="block py-2 px-4 text-sm hover:bg-gray-300 text-black">Cart</a>
                <a href="logout.php" class="block py-2 px-4 text-sm hover:bg-gray-300 text-black">Logout</a>
            <?php else: ?>
                <!-- User is not logged in -->
                <a href="login.php" class="block py-2 px-4 text-sm hover:bg-gray-300 text-black">Sign In</a>
                <a href="register.php" class="block py-2 px-4 text-sm hover:bg-gray-300 text-black">Sign Up</a>
                <a href="cart.php" class="block py-2 px-4 text-sm hover:bg-gray-300 text-black">Cart</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
    // Toggle mobile menu
    const menuButton = document.getElementById("menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    menuButton.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });
</script>
</body>
</html>

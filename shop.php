<!-- Shop Page -->
<?php include 'navandside.php'; ?>

<div class="bg-white py-10">
    <div class="container mx-auto px-4">
        <!-- <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Shop</h2> -->

        <!-- Filter and Sorting Section -->
        <div class="flex flex-wrap items-center justify-between mb-6">
            <!-- Categories Dropdown -->
            <div class="relative inline-block w-48">
                <select id="category-filter" class="block w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Categories</option>
                    <!-- Categories will be loaded dynamically here -->
                </select>
            </div>

            <!-- Sorting Dropdown -->
            <div class="relative inline-block w-48">
                <select id="sort-filter" class="block w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Sort by</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                    <option value="popularity">Popularity</option>
                    <option value="newest">Newest Arrivals</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div id="products" class="bg-white py-10">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="product-grid">
                    <!-- Dynamic products will be loaded here via Ajax -->
                </div>
            </div>
        </div>

        <!-- Pagination (Optional) -->
       
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // On page load, load categories and products
    loadCategories();
    loadProducts();

    // Load categories dynamically
    function loadCategories() {
        $.ajax({
            url: 'get_categories.php', // Fetch categories from the server
            method: 'GET',
            success: function(data) {
                $('#category-filter').append(data); // Populate the category dropdown
            }
        });
    }

    // Load products based on selected filters (category, sorting)
    function loadProducts() {
        var category = $('#category-filter').val();
        var sort = $('#sort-filter').val();
        $.ajax({
            url: 'get_products.php', // Fetch products based on filters
            method: 'GET',
            data: { category: category, sort: sort }, // Use category instead of name
            success: function(data) {
                $('#product-grid').html(data); // Update the products grid
            }
        });
    }

    // When category or sort options change, reload the products
    $('#category-filter, #sort-filter').change(function() {
        loadProducts();
    });
});

</script>

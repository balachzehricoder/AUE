<?php
include 'admin/confiq.php';

// Define the searchProducts function


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <!-- Bootstrap styles -->
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
    <link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
    <link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
    <style>
        .img {
            height: 100px;
        }
    </style>
</head>
<body>

<?php include 'navandside.php' ?>

<div class="span9">
    <div class="well well-small">
        <h4>Latest Products</h4>
        <ul class="thumbnails product">
            <?php
            // Check if the search query is set and not empty
            if (isset($_GET['q']) && !empty($_GET['q'])) {
                // Perform the search
                $search_query = $_GET['q'];
                $products = searchProducts($search_query);

                // Check if the products array is empty after search
                if (empty($products)) {
                    echo '<center><div class="col-12 edit"><h1 class="text-danger">No products found for the search query: ' . htmlspecialchars($search_query) . '</h1></div></center>';
                } else {
                    // Loop through the products and display them
                    foreach ($products as $product) {
                        ?>
                        <li class="col-2">
                            <div class="thumbnail product">
                                <a href="full_page.php?id=<?php echo htmlspecialchars($product['id']); ?>"><img class="img" src="<?php echo htmlspecialchars($product["img_upload"]); ?>" alt=""/></a>
                                <div class="caption">
                                    <h5><?php echo htmlspecialchars($product["p_name"]); ?></h5>
                                    <h5>Rs <?php echo number_format($product["p_price"]); ?></h5>
                                    <h4 style="text-align:center">
                                        <a class="btn" href="wishlist.php?id=<?php echo htmlspecialchars($product['id']); ?>"><i class="icon-heart"></i></a>
                                        <a class="btn" href="add-to-cart.php?id=<?php echo htmlspecialchars($product['id']); ?>">Add to <i class="icon-shopping-cart"></i></a>
                                    </h4>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                }
            } else {
                // If no search query is entered
                echo '<center><div class="col-12 edit"><h1 class="text-danger">Please enter a search query.</h1></div></center>';
            }
            ?>
        </ul>
    </div>
</div>

</body>
</html>

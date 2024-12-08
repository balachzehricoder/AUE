<?php
include 'admin/confiq.php';




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>min and max price product</title>
</head>
<body>
    	
<!-- Bootstrap style --> 
<link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
	<style type="text/css" id="enject"></style>
    <link rel="icon" href="logo.png">

  </head>
<style>
.img{
    height: 100px;
}
</style>
<?php include 'navandside.php' ?>


  <div class="span9">
                    <div class="well well-small">
                        <h4>Latest Products</h4>
                        <ul class="thumbnails product"><?php
        if (isset($_GET['minPrice']) && isset($_GET['maxPrice'])) {
            // Perform the price range filter
            $minPrice = $_GET['minPrice'];
            $maxPrice = $_GET['maxPrice'];
            $products = getProductsByPriceRange($minPrice, $maxPrice);
        } else {
            // Fetch all products
            // $products = getAllProducts();
        }

        if (empty($products)) {
            echo '<center><div class="col-12 edit"><h1 class="text-danger">No products found in your price range </h1></div></center>';
        }

?>
  <div class="span9">
        <div class="well well-small">
            <h4></h4>
            <ul class="thumbnails product">
                <?php
        foreach ($products as $product) {
?>


            <li class="col-2">
			 <div class="thumbnail product">
                                            <a href="full_page.php?id=<?php echo $product['id'];?>"><img class="img"  src="<?php echo $product["img_upload"]; ?>" alt=""/></a>
                                            <div class="caption">
                                                <h5><?php echo $product["p_name"]; ?></h5>
                                                <h5>Rs <?php echo number_format( $product  ["p_price"]); ?></h5>
                                                <h4 style="text-align:center">
                                                    <a class="btn" href="product_details.html"> <i class="icon-heart"></i></a>
                                                    <a class="btn" href="add-to-cart.php?id=<?php echo $product['id']; ?>">Add to <i class="icon-shopping-cart"></i></a>
                                                </h4>
                                            </div>
                                        </div>
                                    </li>

                            <?php
                                }
                            
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>






















</body>
</html>
<?php
// category.php

error_reporting(E_ALL);


// Check if the category ID parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the category ID from the URL
    $category_id = $_GET['id'];
?>
    
        <?php
    include 'admin/confiq.php';

      
      ?>
      </li>
    </ul>
  </div>
</div>
</nav>
<?php
    // Connect to the database (Replace "hostname", "username", "password", and "database_name" with your actual database credentials)
    include 'admin/confiq.php';
    // Check the connection
    // ...

    // Fetch the category details from the database
    $category_query = "SELECT * FROM categories WHERE id = ?";
    $stmt = $conn->prepare($category_query);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $category = $result->fetch_assoc();
   

    // Fetch the products for the selected category from the database
    $products_query = "SELECT * FROM products WHERE category_id = ?";
    $stmt = $conn->prepare($products_query);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    // If the category ID parameter is not set, redirect to the index.php or any other desired page
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    
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

  <head>
    <meta charset="utf-8">
    <title><?php echo $category['name'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->
	
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
  </head>
  <style>
    .img{

		height: 100px;
        
    }
	
  </style>
<body>
<!-- Sidebar end=============================================== -->

<?php include 'navandside.php'; ?>

    <!-- Include the navbar from navs2.php -->

    <!-- Display the products for the selected category using Bootstrap cards -->
        <div class="span9">
                    <div class="well well-small">
                    <h4><?php echo $category['name']; ?></h4>
                        <ul class="thumbnails product">
            <?php while ($product = $result->fetch_assoc()) { ?>
               <li>
                <div class="thumbnail product">
                                            <a href="full_page.php?id=<?php echo $product['id']; ?>"><img class="img"  src="<?php echo $product["img_upload"] ?>" alt=""/></a>
                                            <div class="caption">
                                                <h5><?php echo $product  ["p_name"] ?></h5>
                                                <h5>Rs <?php echo number_format( $product["p_price"]); ?></h5>
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
                        </li>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
 include 'navandside.php' ;





function getWishlistItemsForUserview($user_id) {
    include 'admin/confiq.php';
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get wishlist items for a specific user, including product image
    $sql = "SELECT products.*, wishlist.wishlist_id AS wishlist_id
            FROM wishlist
            INNER JOIN products ON wishlist.product_id = products.id
            WHERE wishlist.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $wishlistItems = array();

    while ($row = $result->fetch_assoc()) {
        $wishlistItems[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $wishlistItems;
}

// The Session Use

include 'includes/config.php';
$id = $_SESSION["user_id"];
$query = "SELECT * FROM users where id='$id'";

// Replace '123' with the actual user ID
$user_id = $id;

$wishlistItems = getWishlistItemsForUserview($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <meta name="author" content="">
    <!--Less styles -->
    <!-- Other Less css file //different less files have different color scheme
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
    <link rel="icon" href="logo.png">

</head>
<style>
    .empty {
        color: red;
        font: 600;
        font-weight: 500;
        font-display: initial;
        font-style: oblique;
        font-variant: small-caps;
        text-decoration: dotted;
        text-align: center;
        text-transform: uppercase;
        text-decoration-color: red;
    }
</style>
<body>
<div class="span9">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($wishlistItems as $item) {
            ?>
            <tr>
                <td> <img width="60" src="admin/<?php echo $item['img_upload']; ?>" alt=""/></td>
                <td><?php echo $item['p_name']; ?><br/>Color : black, Material : metal</td>
                <td>Rp<?php echo number_format($item['p_price']); ?></td>
                <td>
                    <a href="delete-wishlist-item.php?id=<?php echo $item['wishlist_id']; ?>" class="btn btn-danger" role="button">
                        <i class="icon-remove icon-white"></i> Remove


                        

                    </a>


                    <a href="add-to-cart.php?id=<?php echo $item['wishlist_id']; ?>" class="btn btn-sucess" role="button">
                        <i class="icon-cart icon-white"></i> add to cart

                        
                        

                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

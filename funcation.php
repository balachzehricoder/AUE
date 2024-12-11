<?php


//// catigroy product
//
//function getAllCategories() {
//   include 'admin/confiq.php';
//;
//    $query = "SELECT * FROM categories";
//    $result = $conn->query($query);
//
//    if ($result->num_rows > 0) {
//        return $result->fetch_all(MYSQLI_ASSOC);
//    } else {
//        return array();
//    }
//}





// search products
// ...
//function searchProducts($search_query) {
//    global $conn;
//    $sql = "SELECT * FROM products WHERE p_name LIKE ? OR p_description LIKE ?";
//    $stmt = $conn->prepare($sql);
//
//    // Check if the statement was prepared correctly
//    if ($stmt === false) {
//        die('MySQL prepare error: ' . $conn->error);
//    }
//
//    $search_term = "%" . $search_query . "%";
//    $stmt->bind_param("ss", $search_term, $search_term);
//    $stmt->execute();
//
//    // Check if there are any results
//    $result = $stmt->get_result();
//    if ($result->num_rows == 0) {
//        die('No results found for your query');
//    }
//    return $result->fetch_all(MYSQLI_ASSOC);
//}
//
//?>



<!---->
<!---->
<!--// price range products-->
<!---->
<!--function getProductsByPriceRange($minPrice, $maxPrice) {-->
<!--    global $conn;-->
<!--    $query = "SELECT * FROM products WHERE p_price >= ? AND p_price <= ?";-->
<!--    $stmt = $conn->prepare($query);-->
<!--    $stmt->bind_param("ii", $minPrice, $maxPrice);-->
<!--    $stmt->execute();-->
<!--    $result = $stmt->get_result();-->
<!--    $products = $result->fetch_all(MYSQLI_ASSOC);-->
<!--    $stmt->close();-->
<!--    return $products;-->
<!--}-->
<!---->
<!---->


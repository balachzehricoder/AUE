<?php
session_start();

if (empty($_SESSION['cart'])) {
  // Handle empty cart case
  echo '<center><h1 class="empty">Your Cart is Empty.</h1></center>';
  echo '<br>';
  echo '<center><a class="btn btn-danger" href="index.php">Return to home</a></center>';
  exit;
}

$cart = $_SESSION['cart'];

// include 'config.php';
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }

// // Insert order into the database
// foreach ($cart as $product_id => $product) {
//   $name = $product['name'];
//   $price = $product['price'];
//   $qty = $product['quantity'];
//   $total = $product['price'] * $product['quantity'];

//   $sql = "INSERT INTO ORDERS (name, price, qty, total) VALUES ('$name', '$price', '$qty', '$total')";

//   if (!$conn->query($sql)) {
//     echo "Error: " . $sql . "<br>" . $conn->error;
//     exit;
//   }
// }

// Retrieve the order ID from the last inserted order
// $order_id = mysqli_insert_id($conn);

// $conn->close();

// Clear the cart after inserting the order


// Generate the user bill and display it
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>User Bill</title>
</head>
<body>
  <h1>User Bill</h1>

  <h3>Order ID: <?php echo $order_id; ?></h3>

  <table class="table">
    <thead>
      <tr>
        <th>img</th>
        <th>Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cart as $product_id => $product) { ?>
      <tr>
        <td><img class="img" src="<?php echo $product['image']; ?>" alt="Sorry, image not available"></td>
        <td><?php echo $product['name']; ?></td>
        <td><?php echo $product['price']; ?></td>
        <td><?php echo $product['quantity']; ?></td>
        <td><?php echo $product['price'] * $product['quantity']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <h3>Total: <?php echo $_SESSION['cart_details']['cart_total_price']; ?></h3>

  <!-- Provide options to print or download the bill as needed -->
  <button class="btn btn-primary" onclick="window.print()">Print</button>
  <a class="btn btn-primary" href="download_bill.php?order_id=<?php echo $order_id; ?>">Download</a>

  <a class="btn btn-primary" href="index.php">countinue shoping</a>

</body>
</html>

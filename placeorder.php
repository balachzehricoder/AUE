
<?php


include 'admin/confiq.php';
session_start();

// Check if the cart is empty.
if (empty($_SESSION['cart'])) {
  echo '<h1 class="empty" >Your Cart is Empty.</h1>';
  echo '<br>';
  echo '<center><a class="btn btn-danger " href="index.php" >Rturn to home</a></center>';
  exit;
}

$cart = $_SESSION['cart'];




// save in database






$insert = false;
if (isset($_POST['submit'])) {


   include 'config.php';
    if (!$conn) {
        echo die("con filed" . mysqli_connect_errno());
    } else {
        echo "connect";
    }

    $name = $_POST['na'];
    $email = $_POST['em'];
    $phone = $_POST['co'];




    $sql = "insert into phonesell.com.orders (name, email, phone)values('$name', '$email', '$phone')";

    //execute the query


    if ($conn->query($sql) == true) {





        $insert = true;
    } else {


        echo "Error  $sql <br> $conn->error";
    }


    $con->close();

}

?>
// <!DOCTYPE html>
// <html lang="en">

// <head>
//     <meta charset="UTF-8">
//     <meta http-equiv="X-UA-Compatible" content="IE=edge">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Document</title>
// </head>

// <body>

//     <?php

//     if ($insert == true) {
//         echo "<p>thanks for submission</p>";
//     }


//     ?>

//     <form action="" method="post">

//         <label for="un">Name</label>
//         <input type="text" name="na" id="un">
//         <br>


//         <label for="une">Email</label>
//         <input type="email" name="em" id="une">
//         <br>
//         <label for="unee">Phone </label>
//         <input type="phone" name="co" id="unee">
//         <br>
//         <input type="submit" value="Submit">






//     </form>




// </body>

// </html>


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="card">
  <div class="card-body mx-4">
    <div class="container">
      <p class="my-5 mx-5" style="font-size: 30px;">Thank for your purchase</p>
      <div class="row">
        <ul class="list-unstyled">
          <li class="text-black"><?php echo $product['name'] ?></li>
          <li class="text-muted mt-1"><span class="text-black">Invoice</span> #12345</li>
          <li class="text-black mt-1">April 17 2021</li>
        </ul>
        <hr>
        <div class="col-xl-10">
          <p>Pro Package</p>
        </div>
        <div class="col-xl-2">
          <p class="float-end">$199.00
          </p>
        </div>
        <hr>
      </div>
      <div class="row">
        <div class="col-xl-10">
          <p>Consulting</p>
        </div>
        <div class="col-xl-2">
          <p class="float-end">$100.00
          </p>
        </div>
        <hr>
      </div>
      <div class="row">
        <div class="col-xl-10">
          <p>Support</p>
        </div>
        <div class="col-xl-2">
          <p class="float-end">$10.00
          </p>
        </div>
        <hr style="border: 2px solid black;">
      </div>
      <div class="row text-black">

        <div class="col-xl-12">
          <p class="float-end fw-bold">Total: $10.00
          </p>
        </div>
        <hr style="border: 2px solid black;">
      </div>
      <div class="text-center" style="margin-top: 90px;">
        <a><u class="text-info">View in browser</u></a>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
      </div>

    </div>
  </div>
</div>
</body>
</html>


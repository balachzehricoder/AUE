<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Privacy Policy - PhoneSell.com</title>
  <!-- Add your CSS stylesheets and JavaScript files here -->
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</head>

<body>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/20034a5f5a.js" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="phonesell.com_logo.png">


	</head>
	<style>
		.nav{
			border: 0px;
		}
	.img{
		height: 50px;
	}</style>
	<body>
	<section class="section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 text-center  ">
				</div>
			</div>
		</div>
		<div class="container">
			<nav class="navbar navbar-expand-lg ftco_navbar ftco-navbar-light nav" id="ftco-navbar">
		    <div class="container">
		    	<a class="navbar-brand" href="index.php"><img class="img" src="phonesell.com_logo.png" alt=""></a>
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="fa fa-bars"></span> Menu
		      </button>
		      <div class="collapse navbar-collapse" id="ftco-nav">
		        <ul class="navbar-nav ml-auto mr-md-3">
		        	<li class="nav-item "><a href="index.php" class="nav-link">Home</a></li>
		        	<li class="nav-item"><a href="contactus.php" class="nav-link">Contact</a></li>
		        	<li class="nav-item"><a href="aboutus.php" class="nav-link">About</a></li>
		        	<li class="nav-item active"><a href="#" class="nav-link">Privecy Policy</a></li>
					<a href="profile.php"><i class="fa-solid fa-user"></i></a>
				 <li> <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping">



					<?php
					//   $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
					//   echo $cart_count;
				  

					if(isset($_SESSION['cart_details']['cart_total_qty']))
					{
						print_r($_SESSION['cart_details']['cart_total_qty']);
					}
					else
					{
						print_r(0);
					}
					?>
				   
				  </i>     </a>
                  </li>
				  <?php 
				 
				  
				  
				 
				 ?>
					<a href="logout.php"><button type="button" class="btn btn-danger">LOG OUT</button></a>

				 
		        </ul>
		      </div>
		    </div>
		  </nav>
    <!-- END nav -->
	

	</section>


	

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

  <header>
    
   </header>

  <!-- Main content section -->
  <section id="privacy-policy">
    <div class="container">
      <h1>Privacy Policy</h1>
      <p>At PhoneSell.com, we value the privacy of our visitors and are committed to protecting it. This Privacy Policy outlines how we collect, use, and safeguard your personal information when you visit our website.</p>

      <h2>Information We Collect</h2>
      <p>We may collect certain personally identifiable information that you voluntarily provide to us, including but not limited to:</p>
      <ul>
        <li>Name</li>
        <li>Email address</li>
        <li>Phone number</li>
        <li>Shipping address</li>
        <li>Payment information</li>
      </ul>
      <p>Please note that we do not store credit card details nor do we share customer details with any third parties unless required by law.</p>

      <h2>How We Use Your Information</h2>
      <p>The information we collect is used for the following purposes:</p>
      <ul>
        <li>To process and fulfill your orders</li>
        <li>To provide customer support and respond to inquiries</li>
        <li>To send you promotional emails, newsletters, or marketing communications (you can opt-out anytime)</li>
        <li>To improve our website and services based on your feedback</li>
      </ul>

      <h2>Cookies</h2>
      <p>We use cookies to enhance your browsing experience. Cookies are small text files that are stored on your computer or mobile device when you visit our website. They help us analyze how users interact with our site and improve its functionality.</p>
      <p>You can modify your browser settings to disable cookies or receive a notification when cookies are being sent. However, please note that disabling cookies may affect the functionality and user experience of our website.</p>

      <h2>Third-Party Links</h2>
      <p>Our website may contain links to third-party websites. Please note that we have no control over the content, privacy policies, or practices of these third-party sites. We encourage you to review the privacy policies of those websites before providing any personal information.</p>

      <h2>Updates to This Privacy Policy</h2>
      <p>We reserve the right to update or modify this Privacy Policy at any time. Any changes made will be reflected on this page with the updated date. We encourage you to review this page periodically to stay informed about how we protect your privacy.</p>

      <h2>Contact Us</h2>
      <p>If you have any questions or concerns regarding this Privacy Policy, please contact us:</p>
      <ul>
        <li>Email: privacy@PhoneSell.com</li>
        <li>Phone: [+123456789]</li>
        <li>Address: [Your company address]</li>
      </ul>
    </div>
  </section>

  <!-- Add your footer section here -->
  <footer>
    <!-- Your footer content goes here -->
  </footer>
</body>

</html>

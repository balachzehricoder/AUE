<?php
session_start();
include 'admin/confiq.php';

if (isset($_SESSION["user_id"])) {
  header("Location: index.php");
  exit();
}

// Function to set user cookies with a longer expiration time
function setUserCookies($user_id, $user_name, $role) {
  setcookie("user_id", $user_id, time() + 3600 * 24 * 30, "/"); // Set to expire in 30 days (adjust as needed)
  setcookie("user_name", $user_name, time() + 3600 * 24 * 30, "/");
  setcookie("role", $role, time() + 3600 * 24 * 30, "/");
}

// Assuming you already have a connection to the database
if (isset($_POST["signup"])) {
  // Collect form data and sanitize inputs
  $full_name = mysqli_real_escape_string($conn, $_POST["signup_full_name"]);
  $email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
  $phone = mysqli_real_escape_string($conn, $_POST["signup_phone"]);
  $address = mysqli_real_escape_string($conn, $_POST["signup_address"]);
  $password = mysqli_real_escape_string($conn, $_POST["signup_password"]);
  $cpassword = mysqli_real_escape_string($conn, $_POST["signup_cpassword"]);

  // Get the sponsor_id from the URL parameter if it's available, otherwise set it to NULL
  $sponsor_id = isset($_GET["referral"]) && !empty($_GET["referral"]) ? mysqli_real_escape_string($conn, $_GET["referral"]) : NULL;

  // Check if passwords match
  if ($password !== $cpassword) {
      echo "<script>alert('Passwords do not match');</script>";
  } else {
      // Check if email already exists in the database
      $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
      if (mysqli_num_rows($check_email) > 0) {
          echo "<script>alert('Email already exists');</script>";
      } else {
          // If sponsor_id is provided, check if it exists in the database
          if ($sponsor_id !== NULL) {
              // Verify that the sponsor exists in the database
              $check_sponsor = mysqli_query($conn, "SELECT id, points FROM users WHERE id = '$sponsor_id'");
              if (mysqli_num_rows($check_sponsor) == 0) {
                  echo "<script>alert('Invalid sponsor ID');</script>";
                  exit();  // Exit if the sponsor ID is invalid
              } else {
                  // Fetch sponsor's current points
                  $sponsor_data = mysqli_fetch_assoc($check_sponsor);
                  $current_points = $sponsor_data['points'];

                  // Add points to the sponsor's account (e.g., 10 points for a referral)
                  $new_points = $current_points + 30;

                  // Update the sponsor's points in the database
                  $update_points = mysqli_query($conn, "UPDATE users SET points = '$new_points' WHERE id = '$sponsor_id'");
                  if (!$update_points) {
                      echo "<script>alert('Error updating sponsor points');</script>";
                      exit();
                  }
              }
          }

          // Hash the password before storing it
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);

          // Insert the new user into the database
          $sql = "INSERT INTO users (full_name, email, phone, address, password, role, referral_id, sponsor_id, personal_points, group_points) 
                  VALUES ('$full_name', '$email', '$phone', '$address', '$hashed_password', 'user', NULL, " . ($sponsor_id ? "'$sponsor_id'" : "NULL") . ", 0, 0)";

          // Execute the query
          if (mysqli_query($conn, $sql)) {
              echo "<script>alert('User registration successful');</script>";
              // Redirect user to login page after successful signup
              echo "<script>window.location.href = 'login.php';</script>";
          } else {
              echo "<script>alert('User registration failed');</script>";
          }
      }
  }
}


if (isset($_POST["signin"])) {
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  $check_email = mysqli_query($conn, "SELECT id, password, full_name, role FROM users WHERE email = '$email'");
  if (mysqli_num_rows($check_email) > 0) {
    $row = mysqli_fetch_assoc($check_email);
    $stored_password = $row['password'];
    if (password_verify($password, $stored_password)) {
      $_SESSION["user_id"] = $row['id'];
      $_SESSION["user_name"] = $row['full_name'];
      $_SESSION["role"] = $row['role'];

      // Set user cookies upon successful login
      setUserCookies($_SESSION["user_id"], $_SESSION["user_name"], $_SESSION["role"]);

      header("Location: index.php");
      exit();
    } else {
      echo "<script>alert('Login details are incorrect. Please try again.');</script>";
    }
  } else {
    echo "<script>alert('Login details are incorrect. Please try again.');</script>";
  }
}
?>

<style>
  /* Add your styles here */
</style>

<a href="https://front.codes/" class="logo" target="_blank">
  <link rel="stylesheet" href="includes/style.css">
</a>
<center>
  <div class="section">
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
            <label for="reg-log"></label>
            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-4 pb-3">Log In</h4>
                      <form action="" method="post">
                        <div class="form-group">
                          <input type="email" name="email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
                          <i class="input-icon uil uil-at"></i>
                        </div>  
                        <div class="form-group mt-2">
                          <input type="password" name="password" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <button type="submit" name="signin" class="btn mt-4">signin</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-4 pb-3">Sign Up</h4>
                      <form action="" method="post">
                        <div class="form-group">
                          <input type="text" name="signup_full_name" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off">
                          <i class="input-icon uil uil-user"></i>
                        </div>  
                        <div class="form-group mt-2">
                          <input type="email" name="signup_email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
                          <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="number" name="signup_phone" class="form-style" placeholder="Your phone" id="logemail" autocomplete="off">
                          <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="text" name="signup_address" class="form-style" placeholder="Your address" id="logemail" autocomplete="off">
                          <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="password" name="signup_password" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="password" name="signup_cpassword" class="form-style" placeholder="Confirm Your Password" id="logpass" autocomplete="off">
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input type="number" name="signup_sponsor_id" class="form-style" placeholder="Sponsor ID (Optional)" id="logpass" autocomplete="off">
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        <button type="submit" name="signup" class="btn mt-4">Sign Up</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</center>

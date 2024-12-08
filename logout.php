<?php
// Get an array of all cookies sent by the client
$allCookies = $_COOKIE;

// Loop through each cookie and clear it
foreach ($allCookies as $cookieName => $cookieValue) {
    // Clear the cookie by setting its expiration time to the past
    setcookie($cookieName, "", time() - 3600, "/");
}

// Redirect to the login page or another desired page
header("Location: login.php");
exit();
?>

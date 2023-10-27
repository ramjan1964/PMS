<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['userlogin1'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();
}

// Redirect to the login page
header('location: pages_sign-in.php');
exit;
?>

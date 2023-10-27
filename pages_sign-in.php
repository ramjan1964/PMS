<?php
// Include your database configuration file
require_once '../db_config.php';

// Start the session
session_start();

// Check if the user is already logged in, then redirect to the sign-in page
if (isset($_SESSION['userlogin1'])) {
    header('location:index.php');
}

// Check if the login form is submitted
if (isset($_POST['userlogin'])) {
    // Get the email/username and password from the form
    $emailUsername = $_POST['email_username'];
    $password = $_POST['password'];

    // Query the database to retrieve user information based on email/username
    $result = mysqli_query($conn, "SELECT * FROM `user` WHERE `email` ='$emailUsername' OR `username`='$emailUsername'");
    
    // Check if a user is found
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password matched, proceed with login
            if ($row['status'] == 1) {
                // Set the userlogin session variable with the user's ID
                $_SESSION['userlogin1'] = $row['official_id']; // Assuming 'user_id' is the identifier of the user in your database
                $success_message = "Login Successful!";
                // You can redirect the user to a dashboard or other pages after a successful login
                header('location:index.php');
            } else {
                $common_error = "This user is inactive. Please contact with MIS team...!";
            }
        } else {
            // Password does not match
            $common_error = "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        $common_error = "User not found. Please check your email/username and try again.";
    }
}
?>
<!doctype html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>PMS</title>
    <!-- BASIC css -->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../vendor/animate.css/animate.css">
    <!-- SECTION css -->
    <!-- ========================================================= -->
    <!-- TEMPLATE css -->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../stylesheets/css/style.css">
</head>
<body>
    <div class="wrap">
        <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body animated slideInDown">
            <!-- LOGO -->
            <div class="logo">
                <h1 class="text-center">PMS</h1>
                <?php
                // Display success message
                if (isset($success_message)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success_message ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }

                // Display common error message
                if (isset($common_error)) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $common_error ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                } 
                ?>
            </div>
            <div class="box">
                <!-- SIGN IN FORM -->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" id="email_username" name="email_username" placeholder="Email or username" value="<?= isset($emailUsername) ? $emailUsername : '' ?>">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-with-icon">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    <i class="fa fa-key"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="checkbox-custom checkbox-primary">
                                    <input type="checkbox" id="remember-me" value="option1" checked>
                                    <label class="check" for="remember-me">Remember me</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" name="userlogin" value="Sign In">
                            </div>
                            <div class="form-group text-center">
                                <a href="pages_forgot-password.php">Forgot password?</a>
                                <hr/>
                                <span>Don't have an account?</span>
                                <a href="pages_register.php" class="btn btn-block mt-sm">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
    <!-- BASIC scripts -->
    <!-- ========================================================= -->
    <script src="../vendor/jquery/jquery-1.12.3.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/nano-scroller/nano-scroller.js"></script>
    <!-- TEMPLATE scripts -->
    <!-- ========================================================= -->
    <script src="../javascripts/template-script.min.js"></script>
    <script src="../javascripts/template-init.min.js"></script>
    <!-- SECTION script and examples -->
    <!-- ========================================================= -->
</body>
</html>

<?php /*
require_once '../db_config.php';
if (isset($_POST['employee_registration_submit'])) {
// Set parameters to form data
$official_id = $_POST['official_id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$designation = $_POST['designation'];
$department = $_POST['department'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone = $_POST['phone'];
$date_of_birth = $_POST['date_of_birth'];
$joinning_date = $_POST['joinning_date'];
$input_errors = array();

// Check for empty fields

if (empty($_POST['official_id'])) {
   $input_errors['official_id'] = "official_id field is required";
}
if (empty($_POST['fname'])) {
   $input_errors['fname'] = "fname field is required";
}
if (empty($_POST['lname'])) {
   $input_errors['lname'] = "lname field is required";
}
if (empty($_POST['designation'])) {
   $input_errors['designation'] = "Designation field is required";
}

if (empty($_POST['department'])) {
   $input_errors['department'] = "Department field is required";
}

if (empty($_POST['username'])) {
   $input_errors['username'] = "Username field is required";
}

if (empty($_POST['email'])) {
   $input_errors['email'] = "Email field is required";
}

if (empty($_POST['password'])) {
   $input_errors['password'] = "Password field is required";
}
if (empty($_POST['confirm_password'])) {
   $input_errors['confirm_password'] = "Confirm Passwords field is required";
}

if (empty($_POST['phone'])) {
   $input_errors['phone'] = "Phone field is required";
}
if (empty($_POST['joinning_date'])) {
   $input_errors['joinning_date'] = "Joinning date field is required";
}
if (empty($_POST['date_of_birth'])) {
   $input_errors['date_of_birth'] = "Date of birth field is required";
}
if ($password !== $confirm_password) {
   $input_errors['password'] = "Password do not match with Confirm Password field";
   $input_errors['confirm_password'] = "Confirm Password do not match with Password field";
}

// Check if username already exists
$existing_username_query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
if (mysqli_num_rows($existing_username_query) > 0) {
    $input_errors['username'] = "This username is already taken. Please choose a different one.";
    $error = "Something went wrong during registration. Please try again.";
}

// Check if email already exists
$existing_email_query = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
if (mysqli_num_rows($existing_email_query) > 0) {
    $input_errors['email'] = "This email is already registered. Please use a different email.";
    $error = "Something went wrong during registration. Please try again.";
}
// Check if there are any input errors
if (count($input_errors) == 0) {
// The rest of your code
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$result = mysqli_query($conn, "INSERT INTO user (official_id, user, designation, department, username, email, password, phone, date_of_birth, joinning_date) 
VALUES ('$official_id', '$fname $lname', '$designation', '$department', '$username', '$email', '$password_hash', '$phone', '$date_of_birth', '$joinning_date')");

if ($result) {
$success = "Registration Successful!";
} else {
$othererror = "Something went wrong. " . mysqli_error($conn);
}

}


}*/

require_once '../db_config.php';

if (isset($_POST['employee_registration_submit'])) {
    $official_id = $_POST['official_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $joinning_date = $_POST['joinning_date'];



    // Initialize input_errors array
    $input_errors = array();

    // Check for empty fields
    $required_fields = ['official_id', 'fname', 'lname', 'designation', 'department', 'username', 'email', 'password', 'confirm_password', 'phone', 'joinning_date', 'date_of_birth'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $input_errors[$field] = ucfirst($field) . " field is required";
        }
    }

    // Password validation
    if (empty($password)) {
        $input_errors['password'] = "Password is required";
    } else {
        // Check if the password meets the criteria
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/', $password)) {
            $input_errors['password'] = "Password must contain at least 1 capital letter, 1 small letter, 1 digit, 1 special character, and be at least 6 characters long.";
        }
    }

    // Additional validation for password and confirm password
    if ($password !== $confirm_password) {
        $input_errors['password'] = "Password does not match with Confirm Password field";
        $input_errors['confirm_password'] = "Confirm Password does not match with Password field";
    }

    // Additional validation for age (18+)
    $dob_timestamp = strtotime($date_of_birth);
    $eighteen_years_ago = strtotime('-18 years');
    if ($dob_timestamp > $eighteen_years_ago) {
        $input_errors['date_of_birth'] = "Must be 18 years or older";
    }

    // Check if official_id already exists
    $existing_official_id_query = mysqli_query($conn, "SELECT * FROM user WHERE official_id = '$official_id'");
    if (mysqli_num_rows($existing_official_id_query) > 0) {
        $input_errors['official_id'] = "This Official ID is already registered. Please use a different one.";
    }

    // Check if username already exists
    $existing_username_query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($existing_username_query) > 0) {
        $input_errors['username'] = "This username is already taken. Please choose a different one.";
    }

    // Check if email already exists
    $existing_email_query = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($existing_email_query) > 0) {
        $input_errors['email'] = "This email is already registered. Please use a different email.";
    }

    // Check if there are any input errors
    if (count($input_errors) > 0) {
        // Display common error message
        $common_error = "Registration Failed! Please check the errors below.";

        // Display input errors individually
        // You can modify this part based on how you want to display errors
       // foreach ($input_errors as $error) {
          //  $common_error .= "<br>$error";
      //  }
    } else {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $result = mysqli_query($conn, "INSERT INTO user (official_id, user, designation, department, username, email, password, phone, date_of_birth, joinning_date) 
         VALUES ('$official_id', '$fname $lname', '$designation', '$department', '$username', '$email', '$password_hash', '$phone', '$date_of_birth', '$joinning_date')");

        if ($result) {
            $success = "Registration Successful!";
            // Clear form fields on successful registration
        } else {
            // Display common error message on database insertion failure
            $common_error = "Something went wrong during registration. Please try again.";
        }
    }
}
?>

<!doctype html>
<!-- ... rest of your HTML code ... -->


<!doctype html>
<html lang="en" class="fixed accounts sign-in">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>PMS</title>

    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../stylesheets/css/style.css">
</head>

<body>
    <div class="wrap">
        <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body animated slideInDown">
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <!--LOGO-->
            <div class="logo">
                <h1 class="text-center">PMS</h1>
                <?php
if (isset($success)) {
    ?>
    <div class="alert alert-success" role="alert">
        <?= $success ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
} if (isset($common_error)) {
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
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" id="official_id" name="official_id"
                                        placeholder="Official ID" pattern="[0-9]{9}"
                                        value="<?= isset($official_id) ? $official_id : '' ?>">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php
                                if (isset($input_errors['official_id'])) {
                                    echo '<span class="input_errors">' . $input_errors['official_id'] . '</span>';
                                }
                                ?>
                            </div>
                            <div class="form-group mt-md">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="input-with-icon">
                                            <input type="text" class="form-control" id="fname" name="fname"
                                                placeholder="First Name" value="<?= isset($fname) ? $fname : '' ?>">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <?php
                                        if (isset($input_errors['fname'])) {
                                            echo '<span class="input_errors">' . $input_errors['fname'] . '</span>';
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="input-with-icon">
                                            <input type="text" class="form-control" id="lname" name="lname"
                                                placeholder="Last Name" value="<?= isset($lname) ? $lname : '' ?>">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <?php
                                        if (isset($input_errors['lname'])) {
                                            echo '<span class="input_errors">' . $input_errors['lname'] . '</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" id="designation" name="designation"
                                        placeholder="Designation" value="<?= isset($designation) ? $designation : '' ?>">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php
                                if (isset($input_errors['designation'])) {
                                    echo '<span class="input_errors">' . $input_errors['designation'] . '</span>';
                                }
                                ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" id="department" name="department"
                                        placeholder="Department" value="<?= isset($department) ? $department : '' ?>">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php
                                if (isset($input_errors['department'])) {
                                    echo '<span class="input_errors">' . $input_errors['department'] . '</span>';
                                }
                                ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Username" value="<?= isset($username) ? $username : '' ?>">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php
                                if (isset($input_errors['username'])) {
                                    echo '<span class="input_errors">' . $input_errors['username'] . '</span>';
                                }
                                ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                        value="<?= isset($email) ? $email : '' ?>">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <?php
                                if (isset($input_errors['email'])) {
                                    echo '<span class="input_errors">' . $input_errors['email'] . '</span>';
                                }
                                ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password" value="<?= isset($password) ? $password : '' ?>">
                                    <i class="fa fa-key"></i>
                                </span>
                                <?php
                                if (isset($input_errors['password'])) {
                                    echo '<span class="input_errors">' . $input_errors['password'] . '</span>';
                                }
                                ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="password" class="form-control" id="confirm-password"
                                        name="confirm_password" placeholder="Confirm Password"
                                        value="<?= isset($confirm_password) ? $confirm_password : '' ?>">
                                    <i class="fa fa-key"></i>
                                </span>
                                <?php
                                if (isset($input_errors['confirm_password'])) {
                                    echo '<span class="input_errors">' . $input_errors['confirm_password'] . '</span>';
                                }
                                ?>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="01*****" pattern="01[1|3|4|5|6|7|8|9][0-9]{8}"
                                        value="<?= isset($phone) ? $phone : '' ?>">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <?php
                                if (isset($input_errors['phone'])) {
                                    echo '<span class="input_errors">' . $input_errors['phone'] . '</span>';
                                }
                                ?>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <span class="input-with-icon">
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                            value="<?= date('Y-m-d', strtotime('-18 years')) ?>">
                                        <i class="fa fa-birthday-cake"></i>
                                    </span>
                                    <?php
                                    if (isset($input_errors['date_of_birth'])) {
                                        echo '<span class="input_errors">' . $input_errors['date_of_birth'] . '</span>';
                                    }
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <span class="input-with-icon">
                                        <input type="date" class="form-control" id="joinning_date" name="joinning_date"
                                            value="<?= isset($joinning_date) ? $joinning_date : date('Y-m-d') ?>">

                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                    <?php
                                    if (isset($input_errors['joinning_date'])) {
                                        echo '<span class="input_errors">' . $input_errors['joinning_date'] . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                    </div>


                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" name="employee_registration_submit"
                            value="register">
                    </div>
                    <div class="form-group text-center">
                        Have an account?, <a href="pages_sign-in.php">Sign In</a>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
    </div>
    <!--BASIC scripts-->
    <!-- ========================================================= -->
    <script src="../vendor/jquery/jquery-1.12.3.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/nano-scroller/nano-scroller.js"></script>
    <!--TEMPLATE scripts-->
    <!-- ========================================================= -->
    <script src="../javascripts/template-script.min.js"></script>
    <script src="../javascripts/template-init.min.js"></script>
    <!-- SECTION script and examples-->
    <!-- ========================================================= -->
</body>


</html>
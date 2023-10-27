<?php
require_once '../db_config.php'; // Include your database configuration file

if (isset($_POST['login'])) {
    $emailUsername = $_POST['email_username'];
    $password = $_POST['password'];

    // Validate the input
    $input_errors = array();

    // Check for empty fields
    $required_fields = ['email_username', 'password'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $input_errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " is required";
        }
    }

    // You can add more validation logic here

    // Check if there are any input errors
    if (count($input_errors) == 0) {
        // Input is valid, proceed with login

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $emailUsername, $emailUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user_data['password'])) {
                $success_message = "Login Successful!";
                // You can redirect the user to a dashboard or other pages after successful login
            } else {
                $common_error = "Incorrect password. Please try again.";
            }
        } else {
            $common_error = "User not found. Please check your email/username and try again.";
        }

        // Close the statement
        $stmt->close();
    }
}
?>

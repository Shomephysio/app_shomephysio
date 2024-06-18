<?php
/*session_start();
require 'config/database.php'; // Assumes you have a file for database connection

function redirect_with_error($error) {
    header("Location: login.php?error=" . urlencode($error));
    exit();
}

// Check if email and password are set
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if ($stmt === false) {
        redirect_with_error("Database error. Please try again later.");
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['user_role'];

            // Redirect to the respective dashboard based on user type
            if ($user['user_role'] == 'admin') {
                header('Location: admin/dashboard.php');
            } elseif ($user['user_role'] == 'doctor') {
                header('Location: doctor/dashboard.php');
            } elseif ($user['user_role'] == 'patient') {
                header('Location: patient/dashboard.php');
            }
            exit();
        } else {
            redirect_with_error("Invalid email or password.");
        }
    } else {
        redirect_with_error("No user found with this email.");
    }

    $stmt->close();
} else {
    redirect_with_error("Please enter both email and password.");
}*/

session_start();
require 'config/database.php'; // Assumes you have a file for database connection

function redirect_with_error($error) {
    header("Location: login.php?error=" . urlencode($error));
    exit();
}

// Check if email and password are set
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if ($stmt === false) {
        redirect_with_error("Database error. Please try again later.");
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['user_role'];
            $_SESSION['user_email'] = $user['email']; // Store the user's email in the session

            // Redirect to the respective dashboard based on user type
            if ($user['user_role'] == 'admin') {
                header('Location: admin/dashboard.php');
            } elseif ($user['user_role'] == 'doctor') {
                header('Location: doctor/dashboard.php');
            } elseif ($user['user_role'] == 'patient') {
                header('Location: patient/dashboard.php');
            }
            exit();
        } else {
            redirect_with_error("Invalid email or password.");
        }
    } else {
        redirect_with_error("No user found with this email.");
    }

    $stmt->close();
} else {
    redirect_with_error("Please enter both email and password.");
}
?>
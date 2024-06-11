<?php
session_start();
require 'config/database.php';

// Check if the user has verified the OTP
if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    header('Location: forgot-password.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_SESSION['otp_email'];

        if ($new_password != $confirm_password) {
            $error = "New password and confirm password do not match.";
        } else {
            // Update the password in the database
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $query = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ss', $hashed_password, $email);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $success = "Password has been reset successfully.";
                // Clear OTP session data after password reset
                unset($_SESSION['otp']);
                unset($_SESSION['otp_email']);
                unset($_SESSION['otp_expiry']);
                unset($_SESSION['otp_sent']);
                unset($_SESSION['otp_verified']);
            } else {
                $error = "Failed to reset password. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function hideAlert(id) {
            setTimeout(function() {
                var alert = document.getElementById(id);
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 20000); // Hide after 5 seconds
        }
    </script>
</head>
<body>
<section class="vh-100 " style="background-color: #508bfc;">
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                <h2 class="text-center">Reset Password</h2>
                <?php if ($error): ?>
                    <div class="alert alert-danger" id="errorAlert"><?php echo $error; ?></div>
                    <script>hideAlert('errorAlert');</script>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success" id="successAlert"><?php echo $success; ?></div>
                    <script>hideAlert('successAlert');</script>
                    <a href="login.php" class="btn btn-primary btn-block mt-3">Go to Login</a>
                <?php endif; ?>
                <?php if (!$success): ?>
                    <form action="reset-password.php" method="POST">
                        <div class="form-group text-left">
                            <label for="new_password">New Password:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="form-group text-left">
                            <label for="confirm_password">Confirm New Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                    </form>
                <?php endif; ?>
                </div>
        </div>
        </div>
        </div>
    </div>
    </section>
</body>
</html>

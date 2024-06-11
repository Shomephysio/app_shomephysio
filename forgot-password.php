<?php
session_start();
require 'config/database.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

error_reporting(E_ALL);

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']); // Use prepared statements to prevent SQL injection
        
        // Query to check if the email exists
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_email'] = $email;
            $_SESSION['otp_expiry'] = time() + 120; // OTP expires in 2 minutes

            // Send the OTP via email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp-relay.brevo.com';
                $mail->SMTPAuth = true;
                $mail->Username = '76270d002@smtp-brevo.com'; // SMTP username
                $mail->Password = 'y03PUcvDO6Xh9B4d'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('shomephysio@gmail.com', 'Your Name');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Your OTP Code';
                $mail->Body    = "Your OTP code is <b>$otp</b>. It will expire in 2 minutes.";

                $mail->send();
                $_SESSION['otp_sent'] = true;
                $success = "OTP has been sent to your email. It will expire in 2 minutes.";
            } catch (Exception $e) {
                $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $error = "No user found with this email.";
        }
    } elseif (isset($_POST['otp'])) {
        $otp = $_POST['otp'];
        if (isset($_SESSION['otp']) && $_SESSION['otp'] == $otp && time() < $_SESSION['otp_expiry']) {
            $_SESSION['otp_verified'] = true;
            header('Location: reset-password.php');
            exit();
        } else {
            $error = "Invalid or expired OTP.";
        }
    }
}

// Handle resend OTP request
if (isset($_GET['resend']) && $_GET['resend'] == '1') {
    $email = $_SESSION['otp_email'];
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_expiry'] = time() + 120;

    // Send the OTP via email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com';
        $mail->SMTPAuth = true;
        $mail->Username = '76270d002@smtp-brevo.com'; // SMTP username
        $mail->Password = 'y03PUcvDO6Xh9B4d'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('shomephysio@gmail.com', 'Your Name');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP code is <b>$otp</b>. It will expire in 2 minutes.";

        $mail->send();
        $success = "OTP has been resent to your email. It will expire in 2 minutes.";
    } catch (Exception $e) {
        $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var resendLink = document.getElementById('resendOtpLink');
    
    if (resendLink) {
        resendLink.style.pointerEvents = 'none'; // Disable link
        resendLink.style.color = 'gray'; // Optional: change color to indicate disabled state
    }

    var interval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(interval);
            if (resendLink) {
                resendLink.style.pointerEvents = 'auto'; // Enable link
                resendLink.style.color = ''; // Optional: reset color
            }
            document.getElementById('otp_input').disabled = true;
            alert('OTP has expired. Please request a new one.');
        }
    }, 1000);
}
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
                <h2 class="text-center">Forgot Password</h2>
                                <?php if ($error): ?>
                    <div class="alert alert-danger" id="errorAlert"><?php echo $error; ?></div>
                    <script>hideAlert('errorAlert');</script>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success" id="successAlert"><?php echo $success; ?></div>
                    <script>hideAlert('successAlert');</script>
                <?php endif; ?>

                <?php if (!isset($_SESSION['otp_sent'])): ?>
                    <form action="forgot-password.php" method="POST">
                        <div class="form-group">
                            <label for="email">Enter your email address:</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    </form>
                <?php else: ?>
                    <div class="text-left">Time remaining: <span id="time">02:00</span></div>
                    <form action="forgot-password.php" method="POST">
                        <div class="form-group">
                            <label for="otp">Enter OTP:</label>
                            <input type="text" class="form-control form-control-lg" id="otp_input" name="otp" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Verify OTP</button>
                    </form>
                    <p><a href="forgot-password.php?resend=1" id="resendOtpLink">Resend OTP</a></p>
                <?php endif; ?>
            </div>
        </div>
        </div>
        </div>
    </div>
    </section>
    <?php if (isset($_SESSION['otp_sent'])): ?>
        <script>
            var otpExpiryTime = <?php echo $_SESSION['otp_expiry'] - time(); ?>;
            var display = document.querySelector('#time');
            if (display) {
                startTimer(otpExpiryTime, display);
            }
        </script>
    <?php endif; ?>
</body>
</html>

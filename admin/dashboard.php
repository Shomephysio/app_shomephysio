<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ucfirst($_SESSION['user_role']); ?> Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../assets/main.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="../assets/mobile.css">
</head>
<body>
    

            <?php require_once '../includes/sidebar.php'; ?>
            <?php require_once '../includes/header.php'; ?>
            
            <main role="main" class="main">
                <div class="main-content">
                    <!-- Dashboard content -->
                    <h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello world!</h1><h1>Hello hemant!</h1>
                </div>
            </main>

    <script src="../assets/javascript.js"></script>
    <script src="https://kit.fontawesome.com/f65a44e7fb.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

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
</head>
<body>
    <?php require_once '../includes/header.php'; ?>
    
    <button class="toggle-sidebar-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
    
    <div class="container-fluid">
        <div class="row">
            <?php require_once '../includes/sidebar.php'; ?>
            
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content-area">
                <div class="pt-3">
                    <h1>Welcome to the <?php echo ucfirst($_SESSION['user_role']); ?> Dashboard</h1>
                    <!-- Dashboard content -->
                </div>
            </main>
        </div>
    </div>

    <script src="../assets/javascript.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden');
        }

        // Initially hide the sidebar on small screens
        if (window.innerWidth <= 768) {
            document.querySelector('.sidebar').classList.add('hidden');
        }

        // Adjust sidebar visibility on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.querySelector('.sidebar').classList.remove('hidden');
            } else {
                document.querySelector('.sidebar').classList.add('hidden');
            }
        });
    </script>
</body>
</html>

<?php
// Function to get user role or redirect if not logged in
function getUserRole() {
    if (isset($_SESSION['user_role'])) {
        return $_SESSION['user_role'];
    } else {
        header('Location: ../index.php');
        exit();
    }
}

$user_role = getUserRole();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <?php echo ucfirst($user_role); ?>
    </a>
    <button class="navbar-toggler" type="button" onclick="toggleSidebar()">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="profile.php">
                    <img src="path_to_profile_picture" class="rounded-circle" alt="Profile Picture" width="30" height="30">
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

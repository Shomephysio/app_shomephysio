<?php

$user_role = getUserRole();
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';

if ($user_email === '') {
    // Redirect to login if user email is not set in the session
    header('Location: ../login.php');
    exit();
}

// Function to get the initials for the profile picture
function getInitials($email) {
    $parts = explode('@', $email);
    if (count($parts) > 0) {
        $username = $parts[0];
        return strtoupper($username[0] . $username[strlen($username) - 1]);
    }
    return 'U';
}

$profile_initials = getInitials($user_email);
?>

<nav class="navbar">
    <div class="navbar-brand">
        <?php echo ucfirst($user_role); ?>
    </div>
    <div class="navbar-toggler" onclick="toggleSidebar()">&#9776;</div>
    <div class="navbar-menu">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <!--<img src="path_to_notification_icon" alt="Notifications" class="icon">-->
                    <i class="fa-solid fa-bell"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <!--<img src="path_to_email_icon" alt="Email" class="icon">-->
                    <i class="fa-solid fa-envelope"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:void(0);" onclick="toggleDropdown()">
                    <div class="profile-pic"><?php echo $profile_initials; ?></div>
                    <?php echo htmlspecialchars($user_email); ?>
                </a>
                <div class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <?php if ($user_role === 'admin') : ?>
                        <a href="admin_settings.php">Admin Settings</a>
                    <?php elseif ($user_role === 'doctor') : ?>
                        <a href="doctor_settings.php">Doctor Settings</a>
                    <?php elseif ($user_role === 'patient') : ?>
                        <a href="patient_settings.php">Patient Settings</a>
                    <?php endif; ?>
                    <a href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
    function toggleSidebar() {
        // Your JavaScript for toggling the sidebar
    }

    function toggleDropdown() {
        const dropdownContent = document.querySelector('.dropdown-content');
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.nav-link')) {
            const dropdownContent = document.querySelector('.dropdown-content');
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        }
    }
</script>


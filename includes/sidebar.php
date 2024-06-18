<?php
// Define or include getUserRole function
function getUserRole() {
    // Replace this with actual logic to get user role
    if (isset($_SESSION['user_role'])) {
        return $_SESSION['user_role'];
    }
    return 'guest'; // Default role if not set
}
// Function to get sidebar links based on user role
function getSidebarLinks($user_role) {
    switch ($user_role) {
        case 'admin':
            return [
                ['url' => 'admin/dashboard.php', 'label' => 'Dashboard', 'icon' => 'fa-tachometer-alt'],
                ['label' => 'Manage Users', 'icon' => 'fa-users', 'items' => [
                    ['url' => 'admin/manage_users.php', 'label' => 'All Users'],
                    ['url' => 'admin/add_user.php', 'label' => 'Add User'],
                    ['url' => 'admin/user_roles.php', 'label' => 'User Roles'],
                ]],
                ['url' => 'admin/reports.php', 'label' => 'Reports', 'icon' => 'fa-chart-bar'],
            ];
        case 'doctor':
            return [
                ['url' => 'doctor/dashboard.php', 'label' => 'Dashboard', 'icon' => 'fa-tachometer-alt'],
                ['url' => 'doctor/appointments.php', 'label' => 'Appointments', 'icon' => 'fa-calendar-check'],
                ['url' => 'doctor/patients.php', 'label' => 'Patients', 'icon' => 'fa-user-injured'],
            ];
        case 'patient':
            return [
                ['url' => 'patient/dashboard.php', 'label' => 'Dashboard', 'icon' => 'fa-tachometer-alt'],
                ['url' => 'patient/appointments.php', 'label' => 'Appointments', 'icon' => 'fa-calendar-alt'],
                ['url' => 'patient/medical_records.php', 'label' => 'Medical Records', 'icon' => 'fa-file-medical'],
            ];
        default:
            return [];
    }
}

$user_role = getUserRole(); // Replace this with actual function to get user role
$sidebarLinks = getSidebarLinks($user_role);
?>

<div class="sidebar">
    <ul class="sidebar-menu">
        <?php foreach ($sidebarLinks as $link): ?>
            <?php if (isset($link['items'])): ?>
                <li class="menu-item dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <span><?php echo $link['label']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($link['items'] as $item): ?>
                            <li><a href="<?php echo $item['url']; ?>"><?php echo $item['label']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php else: ?>
                <li class="menu-item <?php echo basename($_SERVER['PHP_SELF']) == $link['url'] ? 'active' : ''; ?>">
                    <a href="<?php echo $link['url']; ?>">
                        <i class="fas <?php echo $link['icon']; ?>"></i>
                        <span><?php echo $link['label']; ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

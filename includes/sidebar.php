<?php
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
                // Add more admin links as needed
            ];
            break;
        case 'doctor':
            return [
                ['url' => 'doctor/dashboard.php', 'label' => 'Dashboard', 'icon' => 'fa-tachometer-alt'],
                ['url' => 'doctor/appointments.php', 'label' => 'Appointments', 'icon' => 'fa-calendar-check'],
                ['url' => 'doctor/patients.php', 'label' => 'Patients', 'icon' => 'fa-user-injured'],
                // Add more doctor links as needed
            ];
            break;
        case 'patient':
            return [
                ['url' => 'patient/dashboard.php', 'label' => 'Dashboard', 'icon' => 'fa-tachometer-alt'],
                ['url' => 'patient/appointments.php', 'label' => 'Appointments', 'icon' => 'fa-calendar-alt'],
                ['url' => 'patient/medical_records.php', 'label' => 'Medical Records', 'icon' => 'fa-file-medical'],
                // Add more patient links as needed
            ];
            break;
        default:
            return []; // Default empty array if role not recognized
            break;
    }
}

$user_role = getUserRole();
$sidebarLinks = getSidebarLinks($user_role);
?>

<div class="sidebar">
    <div class="list-group">
        <?php foreach ($sidebarLinks as $link): ?>
            <?php if (isset($link['items'])): ?>
                <div class="dropdown">
                    <a href="#" class="list-group-item list-group-item-action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas <?php echo $link['icon']; ?>"></i>
                        <span><?php echo $link['label']; ?></span>
                        <i class="fas fa-chevron-right float-right"></i>
                    </a>
                    <div class="dropdown-menu">
                        <?php foreach ($link['items'] as $item): ?>
                            <a class="dropdown-item" href="<?php echo $item['url']; ?>"><?php echo $item['label']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?php echo $link['url']; ?>" class="list-group-item list-group-item-action <?php echo basename($_SERVER['PHP_SELF']) == $link['url'] ? 'active' : ''; ?>">
                    <i class="fas <?php echo $link['icon']; ?>"></i>
                    <span><?php echo $link['label']; ?></span>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

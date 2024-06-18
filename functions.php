<?php
session_start();

function getUserRole() {
    if (isset($_SESSION['user_role'])) {
        return $_SESSION['user_role'];
    } else {
        header('Location: ../index.php');
        exit();
    }
}
?>

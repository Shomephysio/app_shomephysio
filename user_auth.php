<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $valid_username = "admin";
        $valid_password = "admin123";

        if ($username === $valid_username && $password === $valid_password) {
            $_SESSION["username"] = $username;
            var_dump($_SESSION["username"]); // Debugging statement
            header("Location: admin/index.php");
            exit;
        } else {
            $_SESSION["error"] = "Invalid username or password.";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION["error"] = "Username and password are required.";
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>

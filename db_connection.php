<?php
// Database configuration
$host = 'localhost';
$dbname = 'db_shomephysio';
$username = 'Super_Admin';
$password = 'Super_Admin@123';

try {
    // Create database connection
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Display error message
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>

<?php
$host = 'smtpout.secureserver.net';
$port = 587;
$timeout = 30; // Timeout in seconds

$fp = fsockopen($host, $port, $errno, $errstr, $timeout);
if (!$fp) {
    echo "Error: $errstr ($errno)<br />\n";
} else {
    echo "Database Connection successful!<br />\n";
    fclose($fp);
}
?>

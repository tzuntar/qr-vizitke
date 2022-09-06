<?php
$db_hostname = 'localhost';
$db_username = 'root';
$db_password = 'q3iZeLpiWer2Y7K';
$db_database = 'vizitke_qr';

try {
    $db = new PDO("mysql:host=$db_hostname;charset=utf8;dbname=$db_database", $db_username, $db_password);
    // disable in production
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}

// disable in production
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

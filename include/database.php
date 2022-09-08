<?php
$db_hostname = 'tobija-zuntar.eu';
$db_username = 'tobijazuntar_qr_vizitke';
$db_password = 'MW83wfT3AQsmZ7G';
$db_database = 'tobijazuntar_qr_vizitke';

if (getenv('DEBUG') == 1) {
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
}

try {
    $DB = new PDO("mysql:host=$db_hostname;charset=utf8;dbname=$db_database", $db_username, $db_password);
    if (getenv('DEBUG') == 1) {
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $DB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
} finally {
    unset($db_hostname);
    unset($db_username);
    unset($db_password);
    unset($db_database);
}

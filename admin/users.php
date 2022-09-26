<?php
session_start();
if (!$_SESSION['is_admin'])
    header('Location: /index.php');
require_once 'lazy_mofo.php';
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Administration — Users</title>
	<meta charset='UTF-8'>
	<link rel='stylesheet' type='text/css' href='style.css'>
    <meta name='robots' content='noindex,nofollow'>
</head>
<body>";
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/database.php';
ob_start();
global $DB;
$lm = new lazy_mofo($DB, 'en-us');
$lm->table = 'users';
$lm->identity_name = 'id_user';
$lm->run();
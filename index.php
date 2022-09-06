<?php
session_start();
if (!isset($_SESSION['username']))
    header('Location: login.php');
include_once 'include/database.php';

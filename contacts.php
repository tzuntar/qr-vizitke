<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';

$friend = db_get_friendship($_SESSION['id']);

include_once './include/header.php' ?>
<div class="top-bar has-right">
    <a href="index.php"><img src="./assets/img/back.svg" alt="Nazaj"/></a>
    <h1>Prijatelj na klik</h1>
</div>

<?php
session_start();
if (!isset($_SESSION['username']))
    header('Location: login.php');

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/qr.php';

include_once './include/header.php' ?>
<div class="top-bar has-right">
    <h1>Prijatelj na klik</h1>
    <a href="account.php"><img src="./assets/img/user.svg" alt="Uporabniški račun"/></a>
</div>
<div class="user-card">
    <div class="qr-code">
        <?= makeQR('PNK-' . $_SESSION['identifier']); ?>
    </div>
    <p class="accent-text"><?= $_SESSION['name_surname'] ?></p>
    <p><?= $_SESSION['username'] ?></p>
</div>
<?php include_once './include/footer.php' ?>

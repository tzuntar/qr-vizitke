<?php
session_start();
if (!isset($_SESSION['username']))
    header('Location: login.php');

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/qr.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/config.php';

include_once './include/header.php' ?>
<div class="top-bar has-right">
    <h1>Prijatelj na klik</h1>
    <a href="account.php"><img src="./assets/img/user.svg" alt="Uporabniški račun"/></a>
</div>
<div class="user-card card-more-padding">
    <div class="qr-code">
        <?= makeQR($TOP_LEVEL . '/contact.php?user=' . $_SESSION['identifier']); ?>
    </div>
    <p class="accent-text"><?= $_SESSION['name_surname'] ?></p>
    <p><?= $_SESSION['username'] ?></p>
</div>
<div class="m-tb-3">
    <a href="scan.php"><button>Preberi kodo</button></a>
</div>
<div class="bottom">
    <a class="action-link" href="contacts.php">Moji stiki →</a>
    <?php if ($_SESSION['is_admin']) { ?>
        <p>
            <a class="action-link" href="/admin/users.php">Administracija →</a>
        </p>
    <?php } ?>
</div>
<?php include_once './include/footer.php' ?>

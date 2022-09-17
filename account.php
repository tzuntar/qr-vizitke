<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';

$user = db_get_user($_SESSION['id']);
$place = db_get_place($user['id_place']);
db_update_file_path($_SESSION['id']);

include_once './include/header.php' ?>
    <div class="top-bar has-right">
        <a href="index.php"><img src="./assets/img/back.svg" alt="Nazaj"/></a>
        <h1>Prijatelj na klik</h1>
    </div>
    <div class="user-card card-more-padding">
        <div class="qr-code">
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload">
                <input type="submit" value="nalozi">
            </form>
            <img src="//" alt="Napaka">  <?//nisem našel poti do slik ?>
        </div>
        <p class="accent-text"><?= $_SESSION['name_surname'] ?></p>
        <p><?= $_SESSION['username'] ?></p>
    </div>
    <div class="m-tb-3">
        <p>Prihaja iz: <?= $place['name'] ?></p>
        <p><?= $user['bio']?></p>
    </div>
    <div class="bottom">
        <a class="action-link" href="contacts.php">Moji stiki →</a>
    </div>
<?php include_once './include/footer.php' ?>
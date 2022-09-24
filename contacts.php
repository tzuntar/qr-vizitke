<?php
session_start();
$document_title = 'Moji stiki';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';
$friends = db_get_friendship($_SESSION['id']);

include_once './include/header.php' ?>
<div class="top-bar">
    <a href="index.php"><img src="./assets/img/back.svg" alt="Nazaj"/></a>
    <h1><?= $document_title ?></h1>
</div>
<div>
    <div class="contact-list">
        <?php foreach ($friends as $f) { ?>
            <div class="contact-entry">
                <img class='profile-pic' src="<?= $f['image_path'] ?? '/assets/img/user_square.svg' ?>" alt="Slika
                uporabnika">
                <div class="description">
                    <h2><a href='contact.php?user=<?= $f['identifier'] ?>'><?= $f['name_surname'] ?></a></h2>
                    <p>Dodan/-a dne <?= date('d. m. Y', strtotime($f['added_on'])) ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php include_once './include/footer.php' ?>

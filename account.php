<?php
session_start();
$document_title = 'Moj profil';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';
if (!isset($_SESSION['id']))
    header('Location: login.php');

$user = db_get_user($_SESSION['id']);
$place = db_get_place($user['id_place']);
if (isset($_FILES['fileToUpload']['name']))
    db_update_file_path($_SESSION['id']);

include_once './include/header.php' ?>
    <div class="top-bar">
        <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><img src="./assets/img/back.svg" alt="Nazaj"/></a>
        <h1>Moj profil</h1>
    </div>
    <div class="user-card card-more-padding">
        <div class="profile-pic">
            <img src="<?= $user['image_path'] ?? '/assets/img/user_large.svg' ?>" alt="Slika uporabnika"/>
        </div>
        <p class="accent-text"><?= $_SESSION['name_surname'] ?></p>
        <p><?= $_SESSION['username'] ?></p>
    </div>
    <div class="m-tb-3">
        <div class="userdata-table">
            <div>
                <img src="/assets/img/home.svg" alt=""/>
                <img src="/assets/img/phone.svg" alt=""/>
            </div>
            <div>
                <p>Doma v:</p>
                <p>Telefon:</p>
            </div>
            <div>
                <p><strong><?= $place['name'] ?></strong></p>
                <p><strong><?= $user['phone'] ?></strong></p>
            </div>
        </div>
    </div>
    <div class="m-tb-3">
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload">
            <input type="submit" value="nalozi">
        </form>
    </div>
    <div class="bottom">
        <a class="action-link" href="contacts.php">Moji stiki →</a>
    </div>
<?php include_once './include/footer.php' ?>
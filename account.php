<?php
session_start();
$document_title = 'Moj profil';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';
if (!isset($_SESSION['id']))
    header('Location: login.php');

if (isset($_POST['place'])) {
    if (isset($_FILES['fileToUpload']['name'])) {
        db_update_file_path($_SESSION['id']);
    }
    $place = filter_input(INPUT_POST, 'place', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    db_update_user($_SESSION['id'], $place, $phone, $bio);
}
$user = db_get_user($_SESSION['id']);
if (isset($user['id_place']))
    $place = db_get_place($user['id_place']);

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
    <form method="post" enctype="multipart/form-data" class="account-data-form">
        <div class="m-tb-3">
            <p>
                <label>
                    <input type="text" name="place" placeholder="Kraj bivanja" required
                           value="<?= $place['name'] ?? '' ?>"/>
                </label>
            </p>
            <p>
                <label>
                    <input type="tel" name="phone" placeholder="Telefonska številka" required
                           value="<?= $user['phone'] ?? '' ?>"/>
                </label>
            </p>
            <p>
                <label>
                    <textarea name="bio" placeholder="Opis" required><?= $user['bio'] ?? '' ?></textarea>
                </label>
            </p>
        </div>
        <div class="m-tb-3">
            <p>Spremeni svojo sliko</p>
            <input type="file" name="fileToUpload">
        </div>
        <div class="m-tb-3">
            <input type="submit" value="Shrani"/>
        </div>
    </form>
    <div class="bottom">
        <a class="action-link" href="contacts.php">Moji stiki →</a>
    </div>
<?php include_once './include/footer.php' ?>
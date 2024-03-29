<?php
session_start();
$document_title = 'Stik';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';
if (!isset($_SESSION['id']))
    header('Location: login.php');
if (!isset($_GET['user']))
    header('Location: scan.php');
$user = db_get_user_by_identifier(ltrim($_GET['user'], 'PNK-'));
if (!isset($user['id_user']))
    header('Location: index.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'save')
        db_add_user_contact($_SESSION['id'], $user['id_user']);
    elseif ($_GET['action'] == 'remove')
        db_remove_user_contact($_SESSION['id'], $user['id_user']);
    header('Location: contact.php?user=' . $_GET['user']);
}

$isContact = db_user_is_contact($_SESSION['id'], $user['id_user']);
if (isset($user['id_place']))
    $place = db_get_place($user['id_place']);

include_once './include/header.php' ?>
    <div class="top-bar">
        <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>"><img src="./assets/img/back.svg" alt="Nazaj"/></a>
        <h1>Stik</h1>
    </div>
    <div class="user-card card-more-padding">
        <div class="profile-pic">
            <img src="<?= $user['image_path'] ?? '/assets/img/user_large.svg' ?>" alt="Slika uporabnika"/>
        </div>
        <p class="accent-text"><?= $user['name_surname'] ?></p>
        <p><?= $user['username'] ?></p>
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
                <p><strong><?= $place['name'] ?? 'vesolju' ?></strong></p>
                <p><strong><?= $user['phone'] ?? '' ?></strong></p>
            </div>
        </div>
        <div class="light-border fake-text-area m-top-3">
            <p><?= $user['bio'] ?? '<i>Brez opisa</i>' ?></p>
        </div>
    </div>
    <div class="bottom">
        <a href="contact.php?user=<?= $user['identifier'] ?>&action=<?= $isContact ? 'remove' : 'save' ?>">
            <button><?= $isContact ? 'Odstrani stik' : 'Dodaj stik' ?></button>
        </a>
    </div>
<?php include_once './include/footer.php' ?>
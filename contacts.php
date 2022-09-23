<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';

$friends = db_get_friendship($_SESSION['id']);

include_once './include/header.php' ?>
<div class="top-bar">
    <a href="index.php"><img src="./assets/img/back.svg" alt="Nazaj"/></a>
    <h1>Stiki</h1>
</div>
<div>
    <?php
    foreach ($friends['id_user'] as $f)
        echo ("<div>
                 <img src='uploads/".$f['image_path']."'>
                 <a href='contact.php?user=".$f['id_user']."'>".$f['name_surname']."</a>
              </div>");
    ?>
</div>
<?php include_once './include/footer.php' ?>

<?php
session_start();
$document_title = 'Ustvari račun';

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';

if (isset($_POST['username'])) {

}

include_once './include/header.php' ?>
    <body>
    <div class="top-bar">
        <a href="login.php"><img src="./assets/img/back.svg" alt="Nazaj"/></a>
        <h1>Ustvari račun</h1>
    </div>
    <p class="m-tb-2 w-80">
        <?php if (isset($registrationMessage)) { ?>
            <img class="small-icon" src="./assets/img/warning.svg" alt="Napaka">&nbsp;<?= $registrationMessage ?>
        <?php } else { ?>
            Vnesite podatke za ustvarjanje novega<br/>
            uporabniškega računa
        <?php } ?>
    </p>
    <form method="post">
        <p>
            <label>
                <input class="m-tb-1" type="text" name="name_surname" required
                       placeholder="Ime in priimek"/>
            </label>
        </p>
        <p>
            <label>
                <input class="m-tb-1" type="text" name="username" required
                       placeholder="Uporabniško ime"/>
            </label>
        </p>
        <p>
            <label>
                <input class="m-tb-1" type="password" name="password" required
                       placeholder="Geslo"/>
            </label>
        </p>
        <p>
            <label>
                <input class="m-tb-1" type="password" name="confirm_password" required
                       placeholder="Ponovno vnesite geslo"/>
            </label>
        </p>
        <p>
            <label>
                <input class="m-tb-1" type="tel" name="username" required
                       placeholder="Telefon"/>
            </label>
        </p>
        <p>
            <label>
                <textarea name="bio" placeholder="O meni"></textarea>
            </label>
        </p>
        <input class="m-tb-2" type="submit" value="Prijava"/>
        <div class="bottom">
            <p>Podatke lahko kasneje spremenite v<br/>
                nastavitvah uporabniškega računa</p>
        </div>
    </form>
    </body>
<?php include_once './include/footer.php' ?>
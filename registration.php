<?php
session_start();
$document_title = 'Ustvari račun';

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';

if (isset($_POST['username'])) {
    if (empty($_POST['name_surname'])
        or empty($_POST['phone']
            or empty($_POST['password'])
            or empty($_POST['confirm_password']))) {
        $registerMessage = 'Izpolnite vsa obvezna polja';
    } else {
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if (!password_verify($_POST['confirm_password'], $password_hash)) {
            $registerMessage = 'Gesli se morata ujemati';
        } else {
            $name = filter_input(INPUT_POST, 'name_surname',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $username = filter_input(INPUT_POST, 'username',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $phone = filter_input(INPUT_POST, 'phone',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $user = db_create_user($name, $username, $phone, $password_hash);
            if (!$user) {
                $registerMessage = 'Ustvarjanje novega uporabniškega računa spodletelo';
                return;
            } else {
                $_SESSION['id'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['identifier'] = $user['identifier'];
                $_SESSION['name_surname'] = $user['name_surname'];
                $_SESSION['is_admin'] = $user['is_admin'];
                header('Location: index.php');
            }
        }
    }
}

include_once './include/header.php' ?>
    <div class="top-bar">
        <a href="login.php"><img src="./assets/img/back.svg" alt="Nazaj"/></a>
        <h1>Ustvari račun</h1>
    </div>
    <p class="m-bottom-2 w-80">
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
                <input class="m-tb-1" type="tel" name="phone" required
                       placeholder="Telefon"/>
            </label>
        </p>
        <p>
            <label>
                <textarea name="bio" placeholder="O meni"></textarea>
            </label>
        </p>
        <p>Podatke lahko kasneje spremenite v<br/>
            nastavitvah uporabniškega računa</p>
        <input class="m-tb-2" type="submit" value="Naprej"/>
    </form>
<?php include_once './include/footer.php' ?>
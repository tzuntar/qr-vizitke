<?php
session_start();
$document_title = 'Prijava';

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';

if (isset($_POST['username'])) {
    $username = filter_input(INPUT_POST, 'username',
        FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = $_POST['password'];
    if (empty($username) or empty($password))
        $loginMessage = 'Vnesite oboje, uporabniško ime in geslo';
    else {
        $user = db_get_user($username);
        if ($user and password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['identifier'] = $user['identifier'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['is_admin'] = $user['is_admin'];
            header('Location: index.php');
        } else $loginMessage = 'Napačno uporabniško ime ali geslo';
    }
}

include_once './include/header.php' ?>
    <body>
    <img class="icon" src="./assets/img/icon.svg" alt="Icon"/>
    <h1>Prijatelj na klik</h1>
    <p class="m-tb-2 w-80">
        <?php if (isset($loginMessage)) { ?>
            <img class="small-icon" src="./assets/img/warning.svg" alt="Napaka">&nbsp;<?= $loginMessage ?>
        <?php } else { ?>
            Že imate uporabniški račun?<br/>
            Vnesite svoje prijavne podatke za nadaljevanje
        <?php } ?>
    </p>
    <form method="post">
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
        <input class="m-tb-2" type="submit" value="Prijava"/>
    </form>
    <div class="bottom">
        <p>Še nimate uporabniškega računa?<br/>
            Ustvarite si ga tukaj</p>
        <a class="action-link" href="registration.php">Ustvari račun →</a>
    </div>
    </body>
<?php include_once './include/footer.php' ?>
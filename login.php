<?php
session_start();
$document_title = 'Prijava';

if (isset($_POST['username'])) {
    // form submitted, process the data...

    header('Location: index.php');
}

include_once './include/header.php' ?>
    <body>
    <img src="" alt="Logo"/>
    <h1>Prijatelj na klik</h1>
    <p>Že imate uporabniški račun?<br/>
        Vnesite svoje prijavne podatke za nadaljevanje</p>
    <form method="post">
        <p>
            <label>
                <input type="text" name="username" required
                       placeholder="Uporabniško ime"/>
            </label>
        </p>
        <p>
            <label>
                <input type="password" name="password" required
                       placeholder="Geslo"/>
            </label>
        </p>
        <input type="submit" value="Prijava"/>
    </form>
    <div class="lower">
        <p>Še nimate uporabniškega računa?<br/>
            Ustvarite si ga tukaj</p>
        <a class="action-link" href="registration.php">Ustvari račun →</a>
    </div>
    </body>
<?php include_once './include/footer.php' ?>
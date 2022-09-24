<?php
session_start();
$document_title = 'Preberi kodo';

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/config.php';

include_once './include/header.php' ?>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <div class="top-bar">
        <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><img src="./assets/img/back.svg" alt="Nazaj"/></a>
        <h1>Preberi kodo</h1>
    </div>
    <div class="qr-reader-area" id="qr-reader">

    </div>
    <script>
        function onScanSuccess(decodedText) {
            const idStringStart = '<?= $TOP_LEVEL . '/contact.php?user=' ?>'.length;
            location.href = `contact.php?user=${decodedText.substring(idStringStart)}&source=qr`;
            html5QrcodeScanner.stop();
        }

        function onScanFailure(error) {
            // ignore the failure, continue scanning
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader",
            {fps: 10, qrbox: {width: 250, height: 250}},
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
<?php include_once './include/footer.php' ?>
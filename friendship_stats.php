<?php
session_start();
if (!isset($_SESSION['username']))
    header('Location: login.php');

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/queries.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/qr.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/config.php';

include_once './include/header.php' ?>
    <div class="top-bar">
        <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>"><img src="./assets/img/back.svg" alt="Nazaj"/></a>
        <h1>Statistika stikov</h1>
    </div>
    <div class="margin-top-20">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
                integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <h3 class="margin-lr-20">Statistika dodanih prijateljev po celotni šoli</h3>
        <canvas id="friendshipStats" width="400" height="400"></canvas>
        <script>
            const monthNames = ["Januar", "Februar", "Marec", "April", "Maj", "Junij",
                "Julij", "Avgust", "September", "Oktober", "November", "December"];

            // monthly uploads
            const uploadsData = JSON.parse('<?php
                $stats = db_get_friendship_stats_per_month(6);
                for ($minusMonth = 0; $minusMonth < 6; $minusMonth++) {
                    $month = date('m', strtotime("-$minusMonth month"));
                    foreach ($stats as $s)  // fill the fields of all 6 months even if there's no data for them
                        $results[$month] = $s[0] == $month ? $s[1] : 0;
                }
                if (isset($results)) echo json_encode($results); ?>');
            let months = [];    // map month numbers to names
            Object.keys(uploadsData).reverse().forEach(monthNum => {
                months.push(monthNames[parseInt(monthNum) - 1])
            });
            const ctxUploads = document.getElementById('friendshipStats').getContext('2d');
            const friendshipStatsChart = new Chart(ctxUploads, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'število dodanih prijateljev na mesec',
                        data: Object.values(uploadsData).reverse(),
                        backgroundColor: ['#d501a5'],
                        borderColor: ['#d501a5'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Additions'
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
<?php include_once './include/footer.php' ?>
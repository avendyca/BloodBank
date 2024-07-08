<?php
session_start();
require('config/gemini-api.php');
loginOrRedirect(); notForAdmin();
$dir = read_json('assets/requests-api/response.json');
$container = analyze_word($dir);
?>

<?php
if(isset($_POST['get-away'])){
    generate_json("assets/requests-api/request.json", "assets/requests-api/response.json");
    $dir = read_json('assets/requests-api/response.json');
    $container = analyze_word($dir);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/rekomendasi.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Blood Bank Dashboard</title>
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="back-button.png" alt="">
                </span>
                <div class="text logo-text">
                    <span class="name">Blood Bank</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="dashboard.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="rekomendasi.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Rekomendasi AI</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="informasipendonor.php">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Informasi Donor</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="analisiskadaluarsa.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Darah Kadaluarsa</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="tambahdata.php">
                            <i class='bx bx-pie-chart-alt icon'></i>
                            <span class="text nav-text">Tambah Data</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="profil.php">
                            <i class='bx bx-pie-chart-alt icon'></i>
                            <span class="text nav-text">Profil</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li>
                    <a href="config/logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>

    <table id="kangmas" hidden>
        <tbody>
            <?php for($i=0; $i<5; $i++): ?>
            <tr>
                <td id="code-<?=$i?>"><?=$container[0][$i]?></td>
                <td id="total-<?=$i?>"><?=$container[1][$i]?></td>
            </tr>
            <?php endfor?>
        </tbody>
    </table>

    <div class="container home">
        <main>
            <section class="input-section">
                <h2>Dapatkan Rekomendasi AI untuk Kebutuhan Darah</h2>
                <form action="" method="post">
                    <input type="hidden" name="get-away"/>
                    <button type="button" id="rekomendasiBtn">Dapatkan Rekomendasi</button>
                    <button type="submit" id="rekomendasiBtn">Perbarui Rekomendasi </button>
                </form>
            </section>
            <section class="recommendation-section">
                <h2>Rekomendasi Kebutuhan Darah</h2>
                <div class="recommendation-content" id="rekomendasiDarahContainer">
                    <!-- Rekomendasi AI akan muncul di sini -->
                </div>
            </section>
        </main>
    </div>
    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        });

        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");
            if (body.classList.contains("dark")) {
                modeText.innerText = "Light mode";
            } else {
                modeText.innerText = "Dark mode";
            }
        });

    </script>

    <script src="assets/js/rekomendasi.js"></script>
</body>
</html>

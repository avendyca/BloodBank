<?php
require('config/connection.php');
global $connection;

session_start();
loginOrRedirect(); notForAdmin();

$bloods = get_datas("stok_darah");
$bloodsTransaction = get_datas("transaksi_darah");
?>


<!DOCTYPE html>
<!-- Coding oleh CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
    <!--<title>Dashboard Sidebar Menu</title>--> 
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <!-- <img src="back-button.png" alt=""> -->
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
                            <span class="text nav-text"> Informasi Donor</span>
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
                            <span class="text nav-text">Tambah data</span>
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
                <li class="">
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
    <main class="main-content">
        <header>
            <h1>Dashboard</h1>
        </header>
        <section hidden>
            <table>
            <?php $counter=1?>
                <?php while ($row = mysqli_fetch_assoc($bloodsTransaction)): ?>
                <tr>
                    <td id="kode-<?=$counter?>"><?=$row['kode_darah']?></td>
                    <td id="masuk-<?=$counter?>"><?=$row['darah_masuk']?></td>
                    <td id="keluar-<?=$counter?>"><?=$row['darah_keluar']?></td>
                </tr> <?php $counter++?>
                <?php endwhile; ?>
            </table>
        </section>

        <section>
            <h2>Stok Darah</h2>
            <div class="stock-container">
            <?php $counter=1?>
            <?php while ($row = mysqli_fetch_assoc($bloods)): ?>
                <div class="stock-box" data-stock="<?=$row['stok']?>">
                    <span><?=$row['kode_darah']?></span> 
                    <?=$row['stok']?>
                </div> <?php $counter++?>
            <?php endwhile; ?>
            </div>
            <h2>Histori Grafik Darah Masuk dan Keluar</h2>
            <canvas id="bloodChart" ></canvas>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/dashboard.js"></script>

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

        // Fungsi untuk mengubah warna box stok darah menjadi merah jika stok di bawah 5
        function updateStockBoxColors() {
            const stockBoxes = document.querySelectorAll('.stock-box');
            stockBoxes.forEach(box => {
                const stock = parseInt(box.getAttribute('data-stock'));
                if (stock < 5) {
                    box.classList.add('low');
                }
            });
        }

        // Panggil fungsi updateStockBoxColors saat halaman dimuat
        document.addEventListener('DOMContentLoaded', updateStockBoxColors);
    </script>
</body>
</html>

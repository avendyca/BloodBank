<?php
require('config/connection.php');
global $connection;
$donorDarah = get_bloods();
$total_count = 0;  $total_red = 0;

function isClose($givenDate) {
    $givenDateTime = new DateTime($givenDate);
    $currentDate = new DateTime();
    $diffInDays = $currentDate->diff($givenDateTime)->days;
    $thresholdDays = 7; 

    if ($diffInDays <= $thresholdDays) {
        return "expiring-soon"; 
    } else {
        return ""; 
    }
}
?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="assets/css/analisiskadaluarsa.css">
    
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
                    <img src="back-button.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class= "name">Blood Bank</span>
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

    <div class="main-content">
        <header>
            <h1>Analisis Kadaluwarsa</h1>
        </header>
        <div class="statistics">
            <div class="stat-box">
                <h2>Total</h2>
                <p id="stock-ready">0</p>
            </div>
            <div class="stat-box red">
                <h2>Kedaluwarsa Kurang dari 8 Hari</h2>
                <p id="bakal-expired">0</p>
            </div>
        </div>

        <h2>
            Segera Kedaluwarsa
        </h2>
        
        <table id="expiringTable">
            <thead>
                <tr>
                    <th>Blood type</th>
                    <th>Expiration date</th>
                    <th>Units</th>
                </tr>
            </thead>

            <tbody id="container">
                <table id="expiringTable">
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($donorDarah)): ?>
                        <?php $total_count++?>
                        <?php if(isClose($row['tanggal_kedaluwarsa'])):?>
                            <?php $total_red++?>
                        <?php endif ?>

                        <tr class="<?=isClose($row['tanggal_kedaluwarsa'])?>">
                            <td><?=$row['kode_darah']?></td>
                            <td><?=$row['tanggal_kedaluwarsa']?></td>
                            <td><?=$row['jumlah_kantong']?></td>
                        </tr>    
                    <?php endwhile; ?>
                    </tbody>

                    <?php
                        echo "<script>";
                        echo "document.getElementById('stock-ready').innerHTML = '$total_count';";
                        echo "document.getElementById('bakal-expired').innerHTML = '$total_red';";
                        echo "</script>";
                    ?>
                </table>
            </tbody>
        </table>
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

    <script src="assets/js/analisiskadaluarsa.js"></script>
</body>
</html>

<?php
require('config/connection.php');
global $connection;
session_start();
loginOrRedirect(); notForAdmin();
$bloods = get_datas("stok_darah");

if(isset($_POST['nama_pendonor'])){
    $datasets = [
        $_POST['tanggal_donor'],
        $_POST['nama_pendonor'],
        $_POST['kode_darah'],
        $_POST['jumlah_kantong'],
        $_POST['tanggal_kedaluwarsa'],
        $_POST['jenis_kelamin']
    ]; insert_datas($datasets, "donor_darah");
    update_bloods_stock($_POST['kode_darah'], intVal($_POST['jumlah_kantong']));
    update_pendonor($_POST['jenis_kelamin']);
    tambah_transaksi($_POST['kode_darah'], 'darah_masuk', $_POST['jumlah_kantong']);
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
    <link rel="stylesheet" href="assets/css/tambahdata.css">
    
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
     <!-- tambah data -->
     <div class="content">
        <div class="container">
          <h1>Tambah Stok Darah</h1>

          <form action="" method="POST">
            <label for="tanggal_donor">Tanggal Donor:</label>
            <input type="date" id="tanggal_donor" name="tanggal_donor" required />
  
            <label for="nama_pendonor">Nama Pendonor</label>
            <input type="name" id="nama_pendonor" name="nama_pendonor" required />
  
            <label for="kode_darah">Jenis Darah:</label>
            <select id="kode_darah" name="kode_darah" required>
              <option value="">Pilih jenis darah</option>
                <?php while ($row = mysqli_fetch_assoc($bloods)): ?>
                    <option value="<?=$row['kode_darah']?>"><?=$row['kode_darah']?></option>
                <?php endwhile; ?>
              
            </select>
  
            <label for="jumlah_kantong">Jumlah Stok:</label>
            <input type="number" id="jumlah_kantong" name="jumlah_kantong" required />
  
            <label for="tanggal_kedaluwarsa">Tanggal Kadaluarsa</label>
            <input type="date" id="tanggal_kedaluwarsa" name="tanggal_kedaluwarsa" />
  
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
              <option value="">Jenis kelamin</option>
              <option value="Perempuan">Perempuan</option>
              <option value="Laki-laki">Laki-laki</option>
            </select>
  
            <button type="submit">Tambah Stok</button>
          </form>
        </div>
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
</body>
</html>
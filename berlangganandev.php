<?php
require('config/connection.php');
global $connection; session_start();
notForUser();
$kabupaten = get_kabupaten();
?>

<?php

if(isset($_POST['add-subscriber'])){
    $datas_array = [
        $_POST['input_nama_rs'], 
        $_POST['input_alamat_rs'],
        $_POST['input_kab_rs'],
        $_POST['input_tanggal_regist'],
        $_POST['input_durasi'],
        $_POST['input_selesai']
    ]; insert_datas($datas_array, "rs_berlangganan");   
} 

else if (isset($_POST['delete-id'])){
    delete_datas(($_POST['delete-id']), 'rs_berlangganan');
}

else if (isset($_POST['update-subscriber'])){
    $datasets = [
        $_POST['input_nama_rs'], 
        $_POST['input_alamat_rs'],
        $_POST['input_kab_rs'],
        $_POST['input_tanggal_regist'],
        $_POST['input_durasi'],
        $_POST['input_selesai']
    ]; echo(update_datas($_POST['rs_id'], "rs_berlangganan", $datasets));
} $result = get_datas("rs_berlangganan");
?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="assets/css/berlangganandev.css">
    
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
                        <a href="dashboarddev.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="berlangganandev.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Berlangganan</span>
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


    <div class="right-bar">
        <div class="informasiBerlangganan-container">
            <h1 id="h1-ouputTable">Informasi Berlangganan</h1>
                <table id="outputTable">
                    <tr>
                        <th>Nama Rumah Sakit</th>
                        <th>Alamat Rumah sakit</th>
                        <th>Tanggal Registrasi</th>
                        <th>Durasi Berlangganan</th>
                        <th>Selesai Berlangganan</th>
                        <th>Edit dan Hapus</th>
                    </tr>

                    <!-- spawn here -->
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td id="nama-<?= $row["id_rs"] ?>"><?=$row["nama_rs"] ?></td>
                            <td id="alamat-<?= $row["id_rs"] ?>"><?=$row["alamat_rs"] ?></td>
                            <td id="regist-<?= $row["id_rs"] ?>"><?=$row["tanggal_regist"] ?></td>
                            <td id="durasi-<?= $row["id_rs"] ?>"><?=$row["durasi"] ?></td>
                            <td id="selesai-<?= $row["id_rs"] ?>"><?=$row["selesai"] ?></td>
                            <td id="kab-<?= $row["id_rs"] ?>" hidden><?=$row["kab"] ?></td>

                                <td>
                                    <button
                                    name="<?= $row["id_rs"] ?>"
                                    id="editDataOpenBtn"
                                    onclick="editDataOpen(this)"
                                    >
                                    Edit
                                    </button>

                                    <form action="" method="post"> 
                                        <button type="submit">
                                            Delete
                                        </button>
                                        <input type="hidden" name="delete-id" value="<?= $row["id_rs"] ?>"/>
                                    </form>
                                </td>
                        </tr>
                    <?php endwhile; ?>
                <!-- until there -->
                </table>

            <button
                style="margin-top: 20px; margin-left: 40%"
                id="tampilEditIBBtn"
                onclick="tampilEditIB()"
            >
                Tambah Data
            </button>

            <form id="formContainer" action="" method="POST">
                <input type="hidden" id="hidden-id" name="rs_id"/>

                <label for="namaInput"> Nama Rumah Sakit </label><br />
                <input type="text" id="namaInput" name="input_nama_rs"/><br />

                <label for="alamatInput"> Alamat Rumah sakit </label
                ><br />
                <input type="text" id="alamatInput" name="input_alamat_rs" /><br />

                <label for="kabupatenInput"> Kabupaten </label><br />
                <select id="kabInputStyle" name="input_kab_rs" required>
                    <option id="kabInput" value="">Pilih Kabupaten</option>
                    <?php while ($row = mysqli_fetch_assoc($kabupaten)): ?>
                        <option value="<?=$row['kab'] ?>"><?=$row['kab'] ?></option>
                    <?php endwhile; ?>
                </select>
                
                <label for="tanggalnput"> Tanggal Registrasi </label
                ><br />
                <input type="date" id="tanggalInput" name="input_tanggal_regist"/><br />
                
                <label for="durasiInput"> Durasi Berlangganan </label
                ><br />
                <input id="durasiInput" name="input_durasi"/><br />
                
                <label for="selesaiBerlangganan"
                    >Selesai Berlangganan</label
                ><br />
                
                <input type="date" id="selesaiBerlangganan" name="input_selesai"/>
                <br />
                
                <button id="addDataBtn" type="submit">
                    simpan
                </button>

                <button id="editDataBtn" onclick="editData()">
                    Edit
                </button>

                <input type="hidden" id="submit-type" name="add-subscriber"/>
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

    <script src="assets/js/berlangganandev.js"></script>
</body>
</html>

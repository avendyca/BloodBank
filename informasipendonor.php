<?php
require('config/connection.php');
global $connection;
session_start();
loginOrRedirect(); notForAdmin();

if(isset($_POST['edit-data'])){
    $datasets = [
        $_POST['editStart'],
        $_POST['editNama'],
        $_POST['editKode'],
        $_POST['editJumlah'],
        $_POST['editKedaluwarsa'],
        $_POST['editGender']
    ]; $id = $_POST['id-donor'];
    update_datas($id, "donor_darah", $datasets);
    $bloodNumber = intVal($_POST['editJumlah']) - intVal($_POST['jumlahSebelumnya']);
    update_bloods_stock($_POST['editKode'], $bloodNumber);

    $before = "jumlahSebelumnya"; $after = "editJumlah";
    // menambah value darah keluar ketika yang sebelumnya lebih dari yang diedit
    if($_POST['jumlahSebelumnya']> $_POST['editJumlah']){
        $temp = intVal($_POST['jumlahSebelumnya']) - intVal($_POST['editJumlah']);
        add_darah($temp, $_POST['editKode'], 'darah_keluar');
    }

    // menambah value darah masuk ketika yang sebelumnya kurang dari yang diedit
    elseif($_POST['jumlahSebelumnya']< $_POST['editJumlah']){
        $temp = intVal($_POST['editJumlah']) - intVal($_POST['jumlahSebelumnya']);
        add_darah($temp, $_POST['editKode'], 'darah_masuk');
    }

    elseif($_POST['jumlahSebelumnya'] === $_POST['editJumlah']){
        // nothing happened here - just pass
    }
}

else if(isset($_POST['id-donor-target'])){
    $target = $_POST['id-donor-target'];
    update_bloods_stock($_POST['kode-darah'], intVal($_POST['jumlah-darah']) * (-1));
    tambah_transaksi($_POST['kode-darah'], "darah_keluar", $_POST['jumlah-darah']);
    delete_datas($target, 'donor_darah');
}

$dataPendonor = get_datas("donor_darah");
$genderArray = get_gender_array();
?>

<!-- communicate php with js -->
<script>
    const maleCount = <?=$genderArray[1]?>;
    const femaleCount = <?=$genderArray[0]?>;
</script>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="assets/css/informasipendonor.css">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
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
                    <span class = "name">Blood Bank</span>
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
    <div class="container" style="padding-top : 2%;">
        <h1>Tabel Donor Darah</h1>
        <table id="donorTable">
            <thead>
                <tr>
                    <th>Tanggal Donor</th>
                    <th>Nama Pendonor</th>
                    <th>Tipe Darah</th>
                    <th>Jumlah Kantong</th>
                    <th>Tanggal Kedaluwarsa</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($dataPendonor)): ?>
                <?php ?>
                <tr>
                    <td id="start-<?=$row['id_donor']?>"><?=$row['tanggal_donor']?></td>
                    <td id="nama-<?=$row['id_donor']?>"><?=$row['nama_pendonor']?></td>
                    <td id="kode-<?=$row['id_donor']?>"><?=$row['kode_darah']?></td>
                    <td id="jumlah-<?=$row['id_donor']?>"><?=$row['jumlah_kantong']?></td>
                    <td id="end-<?=$row['id_donor']?>"><?=$row['tanggal_kedaluwarsa']?></td>
                    <td id="jenis-<?=$row['id_donor']?>"><?=$row['jenis_kelamin']?></td>
                    <td id="id-<?=$row['id_donor']?>" hidden><?=$row['id_donor']?></td>
                    
                    <form action="" method="POST">
                        <td>
                            <input name="jumlah-darah" value="<?=$row['jumlah_kantong']?>" hidden/>
                            <input name="kode-darah" value="<?=$row['kode_darah']?>" hidden/>
                            <input name="id-donor-target" value="<?=$row['id_donor']?>" hidden/>
                            <button class="edit-btn" type="button">Edit</button>
                            <button class="delete-btn" type="submit">Hapus</button>
                        </td>
                    </form>
                </tr>
            </tbody>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- Modal untuk Edit -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Edit Data Donor</h2>
            <form id="editForm" action="" method="POST">
                <input type="text" id="id-donor" name="id-donor" hidden/>
                <label for="editStart">Tanggal Donor:</label>
                <input type="date" id="editStart" name="editStart" required>
                <br>
                <label for="editNama">Nama Pendonor:</label>
                <input type="text" id="editNama" name="editNama" required>
                <br>
                <label for="editKode">Tipe Darah:</label>
                <input type="text" id="editKode" name="editKode" required>
                <br>
                <label for="editJumlah">Jumlah Kantong:</label>
                <input type="number" id="editJumlah" name="editJumlah" required>
                <input type="hidden" id="jumlahSebelumnya" name="jumlahSebelumnya">
                <br>
                <label for="editKedaluwarsa">Tanggal Kedaluwarsa:</label>
                <input type="date" id="editKedaluwarsa" name="editKedaluwarsa" required>
                <br>
                <label for="editGender">Jenis Kelamin:</label>
                <select id="editGender" name="editGender" required>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <br> <input type="hidden" name="edit-data"/>
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>

    <h2>Histori Persentase Pendonor Secara Akumulasi Berdasarkan Gender</h2>
    <div class="chart-container">
        <canvas id="genderChart"></canvas>
    </div>

    <script src="assets/js/informasipendonor.js">
        // script.runawayCode();
    </script>

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

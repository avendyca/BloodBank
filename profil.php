<?php
session_start();
require('config/connection.php');
loginOrRedirect(); notForAdmin();
?>

<?php
if(isset($_POST['editName'])){
    $datasets = [
        $_POST['editName'],
        $_POST['editEmail'],
        $_POST['editAlamat'],
        $_POST['editNoTelepon']
    ]; $id = $_SESSION['id'];

    if(isset($_FILES['editProfilePicture'])){
        $namaFile = $_FILES['editProfilePicture']['name'];
        $tempDirc = $_FILES['editProfilePicture']['tmp_name'];
        $extension = explode('.', $namaFile); $extension = end($extension);
        move_uploaded_file($tempDirc, "public/user-images/" . "$id-profile.$extension");
        array_push($datasets,  "$id-profile.$extension"); update_datas($id, "users", $datasets);
        $_SESSION['user_pp'] = "$id-profile.$extension";
    }

    else{
        array_push($datasets, $_SESSION['user_pp']);
        update_datas($id, "users", $datasets);
    }

    $_SESSION['nama_rs'] = $_POST['editName'];
    $_SESSION['email'] = $_POST['editEmail'];
    $_SESSION['alamat'] = $_POST['editAlamat'];
    $_SESSION['no_telp'] = $_POST['editNoTelepon'];
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
    <link rel="stylesheet" href="assets/css/profil.css">
    
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

    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <img id="profilePicture" src="public/user-images/<?=$_SESSION['user_pp']?>" alt="Profile Picture" class="profile-picture">
            </div>
        </div>
        <div class="user-info">
            <div class="info-section">
                <h3>PROFIL PENGGUNA</h3>
                <br>
                <p><strong>Name:</strong> <span id="name"><?=$_SESSION['nama_rs']?></span></p>
                <br>
                <p><strong>Email:</strong> <span id="email"><?=$_SESSION['email']?></span></p>
                <br>
                <p><strong>Alamat:</strong> <span id="alamat"><?=$_SESSION['alamat']?></span></p>
                <br>
                <p><strong>No. Telepon:</strong> <span id="noTelepon"><?=$_SESSION['no_telp']?></span></p>
            </div>
            <button class="edit-button" onclick="editProfile()">Edit</button>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Profile</h2>
            <!-- onsubmit="saveProfile(event)" -->
            <form id="editForm" action=""  enctype="multipart/form-data" method="POST">
                <label for="editName">Name:</label>
                <input type="text" id="editName" name="editName" required>
                <label for="editEmail">Email:</label>
                <input type="email" id="editEmail" name="editEmail" required>
                <label for="editAlamat">Alamat:</label>
                <input type="text" id="editAlamat" name="editAlamat">
                <label for="editNoTelepon">No. Telepon:</label>
                <input type="text" id="editNoTelepon" name="editNoTelepon">
                <label for="editProfilePicture">Profile Picture:</label>
                <input type="file" id="editProfilePicture" name="editProfilePicture" accept="image/*">
                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    <script src="assets/js/profil.js"></script>

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

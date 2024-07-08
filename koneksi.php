<?php
$host = 'localhost'; // Host database
$db   = 'hospital_database'; // Nama database
$user = 'root'; // Username database
$pass = ''; // Password database

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die('Gagal terhubung dengan database: ' . mysqli_connect_error());
}


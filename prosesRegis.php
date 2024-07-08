<?php
require 'koneksi.php';
if (isset($_POST['submit'])) {
    $nama_rs = $_POST['nama_rs'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    
    
    $query = "INSERT INTO users(nama_rs, email,password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sss", $nama_rs, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        header("location: loginrs.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_stmt_close($stmt);
    
}

mysqli_close($koneksi);


?>

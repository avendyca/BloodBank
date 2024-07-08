<?php
session_start();
require('config/connection.php');
onlyForGuest();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" type="text/css" href="assets/css/landingpage.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');
    </style>
</head>
<body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <div class="content">
  

    <div class="main">
        <div class="teks">
            <span><i>Welcome To </i></span>
            <span><i>BLOOD BANK</i></span>
            <a><i>Please Choose Your Role</i></a>
        </div>
        <div class="Pilihan">
            <form action="">
                <a href="loginadmin.php" class="button-link">
                    <input type="button" value="ADMIN">
                </a>
                <br>
                <a href="loginrs.php" class="button-link">
                    <input type="button" value="RUMAH SAKIT">
                </a>
            </form>
        </div>
    </div>

</body>
</html>

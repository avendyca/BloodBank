<?php
global $connection;
$xCon = [
    "localhost",
    "root", "",
    "hospital_database"
]; $connection = mysqli_connect($xCon[0], $xCon[1], $xCon[2], $xCon[3]);

function onlyForGuest(){
    if(isset($_SESSION['login-user']) or isset($_SESSION['login-admin'])){
        if($_SESSION['login-user'] == true){
            header("Location: dashboard.php");
        }

        elseif($_SESSION['login-admin'] == true){
            header("Location: dashboarddev.php");
        }; exit;
    }
}

function onlyForAdmin(){
    if(isset($_SESSION['login-admin'])){
        // nothing happened
    } else header("Location: dashboard.php");
}

function loginOrRedirect($direct="landingpage.php"){
    if(!isset($_SESSION['login-user']) and !isset($_SESSION['login-admin'])){
        header("Location: $direct");
        exit;
    }
}

function notForUser(){
    if(isset($_SESSION['login-user'])){
        if($_SESSION['login-user'] == true){
            header("Location: dashboard.php");
            exit;
        }
    }
}

function notForAdmin($direct="dashboarddev.php"){
    if(isset($_SESSION['login-admin'])){
        if($_SESSION['login-admin'] == true){
            header("Location: $direct");
            exit;
        }
    }
}

function add_darah($addNumber, $kode_darah, $keluarMasuk){
    global $connection;
    $result = mysqli_query($connection, sprintf("SELECT $keluarMasuk from transaksi_darah where kode_darah = '$kode_darah'"));
    $result = mysqli_fetch_assoc($result)[$keluarMasuk]; $total = intVal($result) + $addNumber;
    mysqli_query($connection, sprintf("UPDATE transaksi_darah SET $keluarMasuk = $total WHERE kode_darah = '$kode_darah'"));
}

function get_bloods(){
    global $connection;
    return mysqli_query($connection, "SELECT kode_darah, tanggal_kedaluwarsa, jumlah_kantong FROM donor_darah order by tanggal_kedaluwarsa asc");
}

function get_gender_array(){
    global $connection; $arrayResult = [];
    $result = mysqli_query($connection, "SELECT jumlah_pendonor from pendonor");

    for($i=0; $i<2; $i++){
        $row = mysqli_fetch_assoc($result);
        array_push($arrayResult, $row['jumlah_pendonor']);
    }; return $arrayResult;
}

function update_bloods_stock($bloodType, $number){
    global $connection;
    $result = mysqli_query($connection, sprintf("SELECT STOK FROM STOK_DARAH WHERE KODE_DARAH = '$bloodType'"));
    $result = mysqli_fetch_assoc($result)['STOK']; $total = intVal($result) + $number;
    mysqli_query($connection, sprintf("UPDATE STOK_DARAH SET STOK = $total WHERE kode_darah = '$bloodType'"));
}

function update_pendonor($jenis_kelamin){
    global $connection;
    $result = mysqli_query($connection, sprintf("SELECT JUMLAH_PENDONOR FROM PENDONOR WHERE JENIS_KELAMIN = '$jenis_kelamin'"));
    $result = mysqli_fetch_assoc($result)['JUMLAH_PENDONOR']; $total = intVal($result) + 1;
    mysqli_query($connection, sprintf("UPDATE PENDONOR SET JUMLAH_PENDONOR = $total WHERE JENIS_KELAMIN = '$jenis_kelamin'"));
}

function tambah_transaksi($jenis_darah, $kolomTransaksi, $number){
    global $connection;
    $result = mysqli_query($connection, sprintf("SELECT $kolomTransaksi FROM TRANSAKSI_DARAH WHERE kode_darah = '$jenis_darah'"));
    $result = mysqli_fetch_assoc($result)[$kolomTransaksi]; $total = intVal($result) + $number; 
    mysqli_query($connection, sprintf("UPDATE TRANSAKSI_DARAH SET $kolomTransaksi = $total WHERE kode_darah = '$jenis_darah'"));
}

function get_kabupaten(){
    global $connection;
    return mysqli_query($connection, "SELECT kab FROM KABUPATEN ORDER BY KAB ASC");
}

function get_top_kabupaten(){
    global $connection;
    $query = "SELECT kab, count(*) as jumlah FROM rs_berlangganan group by kab order by jumlah desc limit 5";
    return mysqli_query($connection, $query);
}

function get_datas($tableName){
    global $connection;
    $query = "SELECT * FROM " . $tableName;
    return mysqli_query($connection, $query);
}

function get_datas_by_id($targetID, $tableName){
    global $connection;
    $query = "SELECT * FROM " . $tableName . "WHERE ID_RS = " . $targetID;
    $result = mysqli_query($connection, $query);
    $result = mysqli_fetch_assoc($result)[0];
    return $result;
}

function insert_datas($arrayData, $tableName){
    global $connection;
    if($tableName == 'rs_berlangganan'){
        $query = "INSERT INTO rs_berlangganan (nama_rs, alamat_rs, kab, tanggal_regist, durasi, selesai)";
        $values = sprintf(" values ('$arrayData[0]', '$arrayData[1]', '$arrayData[2]', '$arrayData[3]', '$arrayData[4]', '$arrayData[5]')");
        $query = $query . $values; mysqli_query($connection, $query);
    }

    else if ($tableName == 'donor_darah'){
        $query = "INSERT INTO DONOR_DARAH (TANGGAL_DONOR, NAMA_PENDONOR, KODE_DARAH, JUMLAH_KANTONG, TANGGAL_KEDALUWARSA, JENIS_KELAMIN) VALUES ";
        $query = $query . sprintf("('$arrayData[0]', '$arrayData[1]', '$arrayData[2]', '$arrayData[3]', '$arrayData[4]', '$arrayData[5]')");
        mysqli_query($connection, $query);
    }
}

function delete_datas($targetID, $tableName){
    global $connection;
    if($tableName == 'rs_berlangganan'){
        $query = "DELETE FROM " . $tableName . " WHERE ID_RS = " . $targetID;
        mysqli_query($connection, $query);
    }

    else if($tableName == 'donor_darah'){
        $query = "DELETE FROM " . $tableName . " WHERE ID_DONOR = " . $targetID;
        mysqli_query($connection, $query);
    }
}

function update_datas($targetID, $tableName, $datas){
    global $connection;
    if($tableName == 'rs_berlangganan'){
        $query = "UPDATE RS_BERLANGGANAN SET ";
        $values = sprintf(" NAMA_RS = '$datas[0]', ALAMAT_RS = '$datas[1]', KAB = '$datas[2]', TANGGAL_REGIST = '$datas[3]', DURASI = '$datas[4]', SELESAI = '$datas[5]'");
        $query = $query . $values . 'WHERE ID_RS = ' . $targetID; mysqli_query($connection, $query) . ';';
    }

    else if($tableName == "donor_darah"){
        $query = "UPDATE DONOR_DARAH SET ";
        $values = sprintf(" TANGGAL_DONOR = '$datas[0]', NAMA_PENDONOR = '$datas[1]', KODE_DARAH = '$datas[2]', JUMLAH_KANTONG = '$datas[3]', TANGGAL_KEDALUWARSA = '$datas[4]', JENIS_KELAMIN = '$datas[5]'");
        $query = $query . $values . sprintf("WHERE ID_DONOR = $targetID"); mysqli_query($connection, $query);
    }

    else if($tableName == "users"){
        $query = "UPDATE USERS SET ";
        $values = sprintf(" nama_rs = '$datas[0]', email = '$datas[1]', alamat = '$datas[2]', no_telp = '$datas[3]', user_pp = '$datas[4]'");
        $query = $query . $values . sprintf("WHERE id = $targetID"); mysqli_query($connection, $query);
    }
}
<?php
require('connection.php');
global $connection;


function generate_json($dir = "default", $responseDefault = "default"){
    if($dir == "default") $dir = "../assets/requests-api/request.json";
    $datas = get_datas("stok_darah"); $argument = ""; $counter = 0;
    while($row = mysqli_fetch_assoc($datas)){
        $kode_darah = $row['kode_darah']; $stok = $row['stok'];
        if($counter != 7) $argument .= "$kode_darah sebanyak $stok, ";
        else $argument .= "dan $kode_darah sebanyak $stok"; $counter++;
    }

    $word = "Saat ini stok yang tersedia pada blood banks adalah $argument. Berikan saya 5 rekomendasi gol. darah tambahan stok darah dengan format : A+ 12 Unit, O+ 5 Unit";
    $file = file_get_contents($dir); $jsonData = json_decode($file, true);
    $jsonData['contents'][0]['parts'][0]['text'] = $word; $file = json_encode($jsonData, JSON_PRETTY_PRINT);
    $ch = curl_init("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=AIzaSyAVPuoNxG9azyb8TyWd0_mDaqljb0yAeq0");

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $file);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);   
    curl_close($ch);

    if($responseDefault == "default") $file = '../assets/requests-api/response.json';
    else $file = "assets/requests-api/response.json"; file_put_contents($file, $result);
}

function analyze_word($word="default"){
    if($word == 'default') $word = read_json();
    $listWord = []; $listTotal = []; $status = "unlooking"; 
    $splitted = explode(" ", $word); 
    $bloods = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

    for($i=0; $i<count($splitted); $i++){
        if($status == 'looking-for-unit'){
            if(is_numeric($splitted[$i])) {
                array_push($listTotal, $splitted[$i]);
                $status = 'unlooking';
            }
        }

        if(in_array($splitted[$i], $bloods)){
            array_push($listWord, $splitted[$i]);
            $status = "looking-for-unit";
        } $listNotes = [$listWord, $listTotal];
    } return $listNotes;
}

function read_json($directory = 'default'){
    if($directory == 'default') $directory = '../assets/requests-api/response.json';
    $file = file_get_contents($directory); $jsonData = json_decode($file, true);
    $word = $jsonData['candidates'][0]['content']['parts'][0]['text']; return $word;
}
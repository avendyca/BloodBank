<?php
require('config/connection.php');
global $connection;
session_start();

if($connection){
    header("Location: landingpage.php");
}
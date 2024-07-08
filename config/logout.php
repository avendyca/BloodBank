<?php
require('connection.php');
session_start();
$_SESSION = [];
session_unset();
session_destroy();
header("Location: ../landingpage.php");
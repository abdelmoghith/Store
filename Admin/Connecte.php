<?php

$host = 'mysql-ce374e4-sohaibkartali25-e79a.j.aivencloud.com';
$port = 22916;
$dbname = 'store';
$username = 'student';
$password = 'GBM2024';


$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>



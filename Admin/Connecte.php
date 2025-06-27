<?php

$host = 'xxx';
$port = xxx;
$dbname = 'xxx';
$username = 'xxx';
$password = 'xxx';


$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>



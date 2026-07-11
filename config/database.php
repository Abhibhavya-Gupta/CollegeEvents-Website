<?php
$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'college_events';

$conn = mysqli_connect($host, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}





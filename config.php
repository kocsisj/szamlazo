<?php
$dbHost = 'localhost';
$dbUsername = 'szamla_username';
$dbPassword = 'szamla_password';
$dbName = 'szama_DATABASE';
//mysqli, procedural way
$con = mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);

if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
?>
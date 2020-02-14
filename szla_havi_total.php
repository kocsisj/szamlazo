<?php
include("auth.php");
require_once 'config.php';
//print($_SESSION['username']);
//print($_SESSION['user_id']);
//print($_SESSION['user_status']);
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

$user_id = $_SESSION['user_id'];

$aktualis_honap = date("Y-m"); 
//echo $aktualis_honap;
//echo "<br>";

$query = $db->query("SET NAMES UTF8");  // ez kell, hogy menjenek az יkezetek יב ץû
$query = $db->query("SELECT SUM(szla_total_netto) AS value_sum FROM szla_fej WHERE user_id=$user_id and szla_datum LIKE '".$aktualis_honap."%'");
$row = mysqli_fetch_assoc($query); 
$sum = $row['value_sum'];
if ($sum>=300000)
				{
				$limit="1";
				}
//Print($sum);
?>
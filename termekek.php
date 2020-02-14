<?php
header('Content-Type: text/html; charset=utf-8');
include("auth.php");
require_once 'config.php';
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
//connect with the database
//$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
$user_id = $_SESSION['user_id'];
//get matched data from name table
//print utf8_decode($searchTerm );
//$searchTerm = utf8_decode($searchTerm);

$query = $con->query("SET NAMES UTF8");  // ez kell, hogy menjenek az ékezetek éá őű
$query = $con->query("SELECT * FROM termekek WHERE termek_nev LIKE '%".$searchTerm."%' and user_id = $user_id ORDER BY termek_nev ASC");

$data = array();
while ($row = $query->fetch_assoc()) {
	// átírjuk szövegre, mert ezt fűzzük hozzé a termék megnevezéshez, az adatbázisba tárolásnál majd visszairjuk true-ra
	if ($row['termek_kozv_szolg']=='true') 
		{
		$termek_kozv_szolg="Közvetített szolgáltatás";
		}
		else
		{
		$termek_kozv_szolg="";
		}
$data[] = $row['termek_nev'].' | '.$row['termek_netto_ar'].' | '.$row['termek_afa'].' | '.$row['termek_egyseg'].' | '.$termek_kozv_szolg;
	//array_push($data, $name);	
}
echo json_encode($data);
?>

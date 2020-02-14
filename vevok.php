<?php
include("auth.php");
require_once 'config.php';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
$user_id = $_SESSION['user_id'];
//get matched data from name table
//print utf8_decode($searchTerm );
//$searchTerm = utf8_decode($searchTerm );

$query = $db->query("SET NAMES UTF8");  // ez kell, hogy menjenek az ékezetek éá őű
$query = $db->query("SELECT * FROM vevok WHERE vevo_nev LIKE '%".$searchTerm."%' and user_id = $user_id ORDER BY vevo_nev ASC");

$data = array();
while ($row = $query->fetch_assoc()) {
    $data[] = $row['vevo_nev'].' | '.$row['vevo_orszag'].' | '.$row['vevo_varos'].' | '.$row['vevo_irszam'].' | '.$row['vevo_utca'].' | '.$row['vevo_utca_megnevezes'].' | '.$row['vevo_utca_hazszam'].' | '.$row['vevo_epulet'].' | '.$row['vevo_lepcsohaz'].' | '.$row['vevo_emelet'].' | '.$row['vevo_ajto'].' | '.$row['vevo_adoszam'].' | '.$row['vevo_eu_adoszam'].' | '.$row['vevo_csasz'].' | '.$row['vevo_bankszamla'].' | '.$row['vevo_email'];
	//array_push($data, $name);	
}
echo json_encode($data);
?>

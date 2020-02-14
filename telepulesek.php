<?php

require_once 'config.php';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
//get matched data from name table
//print utf8_decode($searchTerm );
//$searchTerm = utf8_decode($searchTerm );

$query = $con->query("SET NAMES UTF8");  // ez kell, hogy menjenek az ékezetek éá őű
$query = $con->query("SELECT * FROM telepulesek WHERE cit_name LIKE '".$searchTerm."%' or cit_zip LIKE '".$searchTerm."%'  ORDER BY cit_name ASC");

$data = array();
while ($row = $query->fetch_assoc()) {
    $data[] = $row['cit_name'].' | '.$row['cit_zip'] ;
	//array_push($data, $name);	
}
echo json_encode($data);
?>

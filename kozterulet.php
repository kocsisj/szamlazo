<?php 
include 'config.php';
require('auth.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);
//$con = mysql_connect($dbHost,$dbUsername,$dbPassword);
//$dbs = mysql_select_db($dbName, $con);
$user_id = $_SESSION['user_id'];
$tableName = "kozterulet";
$searchTerm = $_GET['term'];
//$result = mysql_query("SELECT * FROM $tableName");
//$result = mysqli_query($con, "SET NAMES UTF8");
//$result = mysqli_query($con, "SELECT kozterulet_jellege FROM $tableName ORDER BY kozterulet_jellege asc");

//$data = array();
//while ( $row = mysqli_fetch_row($result) )
//{
//    $data[] = $row;
//}

$query = $con->query("SET NAMES UTF8");  // ez kell, hogy menjenek az ékezetek éá őű
$query = $con->query("SELECT * FROM kozterulet WHERE kozterulet_jellege LIKE '".$searchTerm."%'  ORDER BY kozterulet_jellege ASC");

$data = array();
while ($row = $query->fetch_assoc()) {
    $data[] = $row['kozterulet_jellege'];
	//array_push($data, $name);	
}



echo json_encode( $data );    
?>



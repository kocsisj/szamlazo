<?php 
include 'config.php';
require('auth.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);
//$con = mysql_connect($dbHost,$dbUsername,$dbPassword);
//$dbs = mysql_select_db($dbName, $con);
$user_id = $_SESSION['user_id'];
$tableName = "penznem";
//$result = mysql_query("SELECT * FROM $tableName");
$result = mysqli_query($con, "SELECT * FROM $tableName where user_id = $user_id or user_id = 0 order by penznem_nev asc ");

$data = array();
while ( $row = mysqli_fetch_row($result) )
{
    $data[] = $row;
}
echo json_encode( $data );    
?>



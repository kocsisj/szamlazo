<?php  
require('auth.php');
include('config.php');    //include of db config file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$username = ($_SESSION['username']);
$user_id=$_SESSION["user_id"];

// szamla szam generalas és beallitott megjegyzesek
			//elotag és megjegyzések
			$select="SELECT * FROM szla_beallitasok where user_id=$user_id";
			$result = mysqli_query( $con, $select );
			$row = mysqli_fetch_assoc($result);
			$szla_elotag = $row['szla_elotag'];
			
			//szam
			$select="SELECT MAX(szla_szam) AS max_szla_szam FROM szla_fej where user_id='$user_id' and szla_elotag='$szla_elotag'";
			$result = mysqli_query( $con, $select );
			$row = mysqli_fetch_assoc($result);
			$szla_szam = $row['max_szla_szam'];
			$szla_szam = $szla_szam +1;
			$szla_szam = sprintf('%06d', $szla_szam);
			$szla_sorszam_s = $szla_elotag."/".$szla_szam;   //az uj storno számla számlaszáma


$szla_sorszam = $_REQUEST['szla_sorszam'];


//számla fejléc query
//$query = "SET NAMES cp1250"; 
//$result = mysqli_query($con, $query);

$sql = "SET NAMES UTF8";
$retval = mysqli_query( $con, $sql );

$query = "CREATE TEMPORARY TABLE tmp_fej SELECT * FROM szla_fej WHERE user_id=$user_id and szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_fej SET table_line_id='null' WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_fej SET szla_total_netto = szla_total_netto * -1,  szla_total_afa = szla_total_afa * -1, szla_total_brutto = szla_total_brutto * -1 WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);
// itt hozzáadjuk a megjegyzésbe az eredeti szamla sorszámot
$query = "UPDATE tmp_fej SET szla_megjegyzes=CONCAT_WS('', 'Eredeti számla sorszáma: $szla_sorszam \n', szla_megjegyzes ) WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$datum = date('Y-m-d');
$query = "UPDATE tmp_fej SET szla_datum = '$datum', szla_status = 'ervenytelenito_szamla' WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);
$query = "UPDATE szla_fej SET szla_status = 'ervenytelen' WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_fej SET szla_sorszam='$szla_sorszam_s', szla_szam='$szla_szam', szla_elotag='$szla_elotag' WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "INSERT INTO szla_fej SELECT * FROM tmp_fej WHERE user_id=$user_id and szla_sorszam='$szla_sorszam_s'"; 
$result = mysqli_query($con, $query);

//számla tétel query
//$query_tetel = "SELECT * FROM szla_tetel where user_id=$user_id and szla_sorszam='$szla_sorszam'"; 
//$result_tetel = mysqli_query($con, $query_tetel);

$query = "CREATE TEMPORARY TABLE tmp_tetel SELECT * FROM szla_tetel WHERE user_id=$user_id and szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_tetel SET table_line_id='null' WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_tetel SET tetel_netto_egysegar = tetel_netto_egysegar * -1, tetel_afaertek = tetel_afaertek * -1, tetel_netto_ertek = tetel_netto_ertek * -1, tetel_brutto_ertek = tetel_brutto_ertek * -1 WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_tetel SET szla_sorszam='$szla_sorszam_s', szla_szam='$szla_szam', szla_elotag='$szla_elotag' WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "INSERT INTO szla_tetel SELECT * FROM tmp_tetel WHERE user_id=$user_id and szla_sorszam='$szla_sorszam_s'"; 
$result = mysqli_query($con, $query);

echo '<br><b>A számla érvénytelenítve:</b>';
//echo '<br><br><a href=szla_pdf3.php?szla_sorszam=' . $szla_sorszam_s . ' class="button_nagy" target="_blank" >Nyomtatás / Megtekintés, Számlaszám: '.$szla_sorszam_s.'</a><br><br><br>';
echo '<br><br><a href=szla_pdf3.php?szla_sorszam=' . $szla_sorszam_s . ' class="button_nagy"  target="popup" onclick=window.open("szla_pdf3.php?szla_sorszam=' .  $szla_sorszam_s . '","name","width=800,height=800")>Nyomtatás / Megtekintés, Számlaszám: '.$szla_sorszam_s.'</a><br><br><br>';
?>

<?php 
require('config.php');
include("auth.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);
$user_id=$_SESSION["user_id"];
$query = "SET NAMES UTF8"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
$query = "SELECT * from felhasznalok where user_id='".$user_id."'"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
$row = mysqli_fetch_assoc($result);

/*
echo $row['felhasznalo_nev'];echo '<br>';
echo $row['felhasznalo_orszag'];echo '<br>';
echo $row['felhasznalo_varos'];echo '<br>';
echo $row['felhasznalo_irszam'];echo '<br>';
echo $row['felhasznalo_utca'];echo '<br>';
echo $row['felhasznalo_utca_megnevezes'];echo '<br>';
echo $row['felhasznalo_utca_hazszam'];echo '<br>';
echo $row['felhasznalo_epulet'];echo '<br>';
echo $row['felhasznalo_lepcsohaz'];echo '<br>';
echo $row['felhasznalo_emelet'];echo '<br>';
echo $row['felhasznalo_ajto'];echo '<br>';
echo $row['felhasznalo_adoszam'];echo '<br>';
echo $row['felhasznalo_csasz'];echo '<br>';
echo $row['felhasznalo_bankszamla'];echo '<br>';
echo $row['felhasznalo_email'];echo '<br>';
echo $row['trn_date'];echo '<br>';
*/

echo '<center>';
echo '<br>
A Nemzetgazdasági Minisztérium 23/2014. (VI. 30.) rendelete alapján az Ön kötelesége és felelősége, hogy a számlázóprogram  <br> használatának kezdetét bejelentse az adóhatóság (NAV) felé. <br><br>
A belenetést a NAV által kiadott ÁNYK program segítségével Ön vagy könyvelője tudja elvégezni. <br><br>
<font color=red>
!!! A bejelentést a szoftver használatba vételétől (az első számla kiállításától) számított 15 napon belül kell megtennie. !!!</font><br><br><br>
A SZAMLAZO nevű ÁNYK nyomtatvány kitöltött verziójához kattintson a gombra: <br>';

$mai_datum = date("Ymd");
$hasznalatbavetel_datum = strtotime( $row['trn_date'] );
$hasznalatbavetel_datum = date( 'Ymd', $hasznalatbavetel_datum );

$username = $row['username'];
$path_to_file = 'nav_szamlazo_nyomtatvany/kszamla_bejelento_alap.xml';
$path_to_file_new = 'nav_szamlazo/'.$username.'_kszamla_nav_bejelento.xml';
$file_contents = file_get_contents($path_to_file);

$file_contents = str_replace("adozo_adoszama",$row['felhasznalo_adoszam'],$file_contents);
$file_contents = str_replace("adozo_neve",$row['felhasznalo_nev'],$file_contents);
$file_contents = str_replace("adozo_irszam",$row['felhasznalo_irszam'],$file_contents);
$file_contents = str_replace("adozo_varos",$row['felhasznalo_varos'],$file_contents);
$file_contents = str_replace("adozo_utca_neve",$row['felhasznalo_utca'],$file_contents);
$file_contents = str_replace("adozo_utca_jel",$row['felhasznalo_utca_megnevezes'],$file_contents);
$file_contents = str_replace("adozo_hazszam",$row['felhasznalo_utca_hazszam'],$file_contents);
$file_contents = str_replace("adozo_epulet",$row['felhasznalo_epulet'],$file_contents);
$file_contents = str_replace("adozo_emelet",$row['felhasznalo_emelet'],$file_contents);
$file_contents = str_replace("adozo_lepcsohaz",$row['felhasznalo_lepcsohaz'],$file_contents);
$file_contents = str_replace("adozo_ajto",$row['felhasznalo_ajto'],$file_contents);

$file_contents = str_replace("mai_datum",$mai_datum,$file_contents);
$file_contents = str_replace("hasznalatbavetel_datum",$hasznalatbavetel_datum,$file_contents);

file_put_contents($path_to_file_new,$file_contents);

echo "<br><a href=xml_letoltes.php?file=$path_to_file_new class=button_nagy download><img width=40px src=pic/download.png></img> Kitöltött SZAMLAZO nyomtatvány letöltése <img width=40px src=pic/download.png></img></a>";

?>
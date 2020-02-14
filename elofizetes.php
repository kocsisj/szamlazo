<?php
require('config.php');
//include("auth.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);
$id=$_SESSION["user_id"];
$username = $_SESSION['username'];
$user_status=$_SESSION["user_status"];
$status = "";
if(isset($_POST['elofizetes_aktivalasa']) && $_POST['elofizetes_aktivalasa']==1)
{
$trn_date = date("Y-m-d H:i:s");
$oneYearOn = date('Y-m-d', strtotime('+1 year'));
$felhasznalo_status_code="2";
//$felhasznalo_first_invoice="";

	if ($_POST['fizetesi_mod']=="bank")
	{
	$update="update felhasznalok set felhasznalo_status_code='".$felhasznalo_status_code."', felhasznalo_status_code_date='".$oneYearOn."' where user_id='".$id."'";
	mysqli_query($con, $update) or die(mysql_error());
	$status = "<br><br><center>Az előfizetés aktiválása megtörtént.</br></br>Díjbekérőnket az regsztrációkor megadott e-mail címre fogjuk elküldeni, a díjbekérőn kiegyenlítése után számlát állítunk ki. <br><br>Ammennyiben bármilyen kérdése lenne, kérem vegye fel velünk a kapcsolatot elérhetőségeink egyikén.<br><br><a href='http://kszamla.hu/kapcsolat/' class='button' target='_blank' >Elérhetőségeink</a></center>";
$_SESSION["user_status"]="2";
	}
	if ($_POST['fizetesi_mod']=="paypal")
	{
	include("fizetes_paypal.php");
	//$_SESSION["user_status"]="2";
	}

echo '<p style="color:#FF0000;">'.$status.'</p>';

}else {
		if($user_status==2)
			{
			print('<br><br><center>Jelenleg aktív előfizetéssel rendelkezel');
			$query = "SET NAMES UTF8"; 
			$result = mysqli_query($con, $query) or die ( mysql_error());
			$query = "SELECT * from felhasznalok where user_id='".$user_id."'"; 
			$result = mysqli_query($con, $query) or die ( mysql_error());
			$row = mysqli_fetch_assoc($result);
			print('<br><br>Előfizetésed érvényessége: '.$row['felhasznalo_status_code_date']);

			}
			else
			{
			?>
			<center><br>
			Ammennyiben elő szeretne fizetni, nincs más dolga mint fizetési módot választani és rákattintani a "Tovább" gombra.<br><br>
			Ezután már azonnal használatba tudja venni a számlázóprogramot.<br><br>
			Amikor befizetett összeg a bankszámlánkon jóváírásra kerül, számlát állítunk ki.
<br><br>
				Az előfizetés ára 8500 Ft / év (tartalmazza az áfát)<br><br>
<?
include("fizetes.php");
}
}
?>
</center>
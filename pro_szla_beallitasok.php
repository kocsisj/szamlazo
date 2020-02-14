<?php 
require('config.php');
//include("auth.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);
$id=$_SESSION['user_id'];
$query = "SET NAMES UTF8"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
$query = "SELECT * from pro_szla_beallitasok where user_id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<center>
<h3>Díjbekérő beállítások</h3>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$trn_date = date("Y-m-d H:i:s");
$szla_elotag =$_REQUEST['szla_elotag'];
$szla_megjegyzes =$_REQUEST['szla_megjegyzes'];
//$szla_penzforgelsz =$_REQUEST['szla_penzforgelsz'];
//$szla_onszamla =$_REQUEST['szla_onszamla'];
//$szla_ford_ado =$_REQUEST['szla_ford_ado'];
//$szla_adoment_hiv =$_REQUEST['szla_adoment_hiv'];
//$szla_feliratok =$_POST['szla_feliratok'][0].$_POST['szla_feliratok'][1].$_POST['szla_feliratok'][2].$_POST['szla_feliratok'][3];
$szla_penzforgelsz ="";
$szla_onszamla ="";
$szla_ford_ado ="";
$szla_adoment_hiv ="";
$szla_feliratok = "";
$select="SELECT * FROM pro_szla_beallitasok where user_id=$id";
$update="update pro_szla_beallitasok set szla_elotag='$szla_elotag', szla_megjegyzes='$szla_megjegyzes', szla_feliratok='$szla_feliratok', szla_penzforgelsz='$szla_penzforgelsz', szla_onszamla='$szla_onszamla', szla_ford_ado='$szla_ford_ado', szla_adoment_hiv='$szla_adoment_hiv' where user_id=$id";
$insert="INSERT INTO pro_szla_beallitasok (user_id, szla_elotag, szla_megjegyzes, szla_feliratok, szla_penzforgelsz, szla_onszamla, szla_ford_ado, szla_adoment_hiv ) VALUES ('$id', '$szla_elotag', '$szla_megjegyzes', '$szla_feliratok', '$szla_penzforgelsz', '$szla_onszamla', '$szla_ford_ado', '$szla_adoment_hiv')";
$result = $con->query($select) or die(mysql_error());;
$row = mysqli_num_rows($result);
if ($row !=0){
	//frissitunk ha már van ilyen user
		$result = $con->query($update);
	} else {
	//hozzaadjuk ha meg nincs iylen user
		$result = $con->query($insert);
	}

//mysql_query($update) or die(mysql_error());

$status = "Beállítások mentése megtörtént. </br></br>" ;
echo $status;
echo '<script>
alertify.success ( "Számla beállítások módosítva" );
</script>';
}else {
?>
<div>
<form name="form" method="post" action=""> 
<table width = "900" border ="0" cellspacing = "1" cellpadding = "2">
<input type="hidden" name="new" value="1" />
 <tr>
  <td width = "200">Díjbekérő sorszám előtag:</td>
<td><input type="text" name="szla_elotag" placeholder="Számlaszám előtag" required value="<?php echo $row['szla_elotag'];?>" size="10" />/dijbekérő sorszám</td>

  </tr>
	<!--
<tr>
	<td>
		Pénzforgalmi elszámolás:
	</td>
	<td>
		<input type="hidden" name="szla_penzforgelsz" value="0" />
		<input type="checkbox" name="szla_penzforgelsz" value="true" <?php if ($row['szla_penzforgelsz']=="true") echo "checked";?>/>
	</td>
</tr>
<tr>
	<td>
		Önszámlázás:
	</td>
	<td>
		<input type="hidden" name="szla_onszamla" value="0" />
		<input type="checkbox" name="szla_onszamla" value="true" <?php if ($row['szla_onszamla']=="true") echo "checked";?>/>
	</td>
</tr>
<tr>
	<td>
		Fordított adózás:
	</td>
	<td>
		<input type="hidden" name="szla_ford_ado" value="0" />
		<input type="checkbox" name="szla_ford_ado" value="true" <?php if ($row['szla_ford_ado']=="true") echo "checked";?>/>
	</td>
</tr>
<tr>
	<td>
		Alanyi adómentes vállalkozás:
	</td>
	<td>
		<input type="hidden" name="szla_adoment_hiv" value="0" />
		<input type="checkbox" name="szla_adoment_hiv" value="true" <?php if ($row['szla_adoment_hiv']=="true") echo "checked";?>/>
	</td>
</tr>
	-->
<tr>
   <td></td>   <td><b><br>Ide irhat olyan szöveget ami minden díjbekérőn meg fog jelenni.</b></td>

</tr>
<tr>
	<td>Megjegyzés: </td><td><textarea id="txt-area" style="text-align:left" rows="15" cols="60" name="szla_megjegyzes" ><?php echo $row['szla_megjegyzes'];?></textarea></td>
</tr>
<tr>

	<td></td> 
	<td>
	<input name="submit" type="submit" value="Módosítás" />
	</td>
	</tr>
</table>
</form>

<?php } ?>
</center>
</div>
</div>
</body>
</html>

<script>	
 $(document).ready(

				 /* This is the function that will get executed after the DOM is fully loaded */

				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#kozterulet_jellege").autocomplete({
						  /*Source refers to the list of fruits that are available in the auto complete list. */
						  //source:data,
						  source: 'kozterulet.php',
						  /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
						  it will be loaded in the textbox */
				     	 autoFocus: true ,
						 minLength: 1,

					});

					}  				  
);
</script>
<script>
$(document).ready(

				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#telepulesek").autocomplete({
						  /*Source refers to the list of fruits that are available in the auto complete list. */
						  //source:data,
						  source: 'telepulesek.php',
						  /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
						  it will be loaded in the textbox */
				     	 autoFocus: true ,
						 minLength: 1,
						 max:5,

					});
					$( "#telepulesek").on( "autocompleteselect", function( event, ui ) {
						//alert(ui.item.value);
						value = ui.item.value.split(" | ");
						vevo_nev = value[0];
						vevo_orszag = value[1];

						//volume=1;
						//$(this).val(product);
						//line_number = ($(this).attr("id"));
						//line_number = line_number.split("-");
						//num = line_number[1];
						$("#telepulesek").val(vevo_nev);
						$("#irszam").val(vevo_orszag);

						event.preventDefault();
					} );
				}  				  
);

$(document).ready(

				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#irszam").autocomplete({
						  /*Source refers to the list of fruits that are available in the auto complete list. */
						  //source:data,
						  source: 'telepulesek.php',
						  /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
						  it will be loaded in the textbox */
				     	 autoFocus: true ,
						 minLength: 1,
						 max:5,

					});
					$( "#irszam").on( "autocompleteselect", function( event, ui ) {
						//alert(ui.item.value);
						value = ui.item.value.split(" | ");
						vevo_nev = value[0];
						vevo_orszag = value[1];

						//volume=1;
						//$(this).val(product);
						//line_number = ($(this).attr("id"));
						//line_number = line_number.split("-");
						//num = line_number[1];
						$("#telepulesek").val(vevo_nev);
						$("#irszam").val(vevo_orszag);

						event.preventDefault();
					} );
				}  				  
);
  </script>	
<?php 
require('config.php');
include("auth.php");
error_reporting(E_ALL);
//ini_set("display_errors", 1);
$id=$_REQUEST['id'];
$user_id = $_SESSION['user_id'];
$query = "SET NAMES UTF8"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
$query = "SELECT * from vevok where table_line_id='".$id."' and user_id = $user_id" ; 
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

<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$trn_date = date("Y-m-d H:i:s");
$vevo_nev =$_REQUEST['vevo_nev'];
$vevo_orszag =$_REQUEST['vevo_orszag'];
$vevo_varos =$_REQUEST['vevo_varos'];
$vevo_irszam =$_REQUEST['vevo_irszam'];
$vevo_utca =$_REQUEST['vevo_utca'];
$vevo_utca_megnevezes =$_REQUEST['vevo_utca_megnevezes'];
$vevo_utca_hazszam =$_REQUEST['vevo_utca_hazszam'];
$vevo_epulet =$_REQUEST['vevo_epulet'];
$vevo_lepcsohaz =$_REQUEST['vevo_lepcsohaz'];
$vevo_emelet =$_REQUEST['vevo_emelet'];
$vevo_ajto =$_REQUEST['vevo_ajto'];
$vevo_adoszam =$_REQUEST['vevo_adoszam'];
$vevo_eu_adoszam =$_REQUEST['vevo_eu_adoszam'];
$vevo_csasz =$_REQUEST['vevo_csasz'];
$vevo_bankszamla =$_REQUEST['vevo_bankszamla'];
$vevo_email =$_REQUEST['vevo_email'];
//$submittedby = $_SESSION["username"];
$update="update vevok set vevo_nev='".$vevo_nev."', vevo_orszag='".$vevo_orszag."', vevo_varos='".$vevo_varos."', vevo_irszam='".$vevo_irszam."', vevo_utca='".$vevo_utca."', vevo_utca_megnevezes='".$vevo_utca_megnevezes."', vevo_utca_hazszam='".$vevo_utca_hazszam."', vevo_epulet='".$vevo_epulet."', vevo_lepcsohaz='".$vevo_lepcsohaz."', vevo_emelet='".$vevo_emelet."', vevo_ajto='".$vevo_ajto."', vevo_adoszam='".$vevo_adoszam."', vevo_eu_adoszam='".$vevo_eu_adoszam."', vevo_csasz='".$vevo_csasz."', vevo_bankszamla='".$vevo_bankszamla."', vevo_email='".$vevo_email."' where table_line_id='".$id."' and user_id = $user_id";

mysqli_query($con, $update) or die(mysql_error());
print ("Vevő módosítás megtörtént. ");
include("vevok_lista.php");
}else {
?>
<div>
<h3>Vevő módosítás</h3>
<form name="form" method="post" action=""> 
<table width = "600" border ="0" cellspacing = "1" cellpadding = "2">
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['table_line_id'];?>" />
                     <tr>
                        <td width = "150">Név / Cégnév</td>
<td><input type="text" name="vevo_nev" placeholder="Név" required value="<?php echo $row['vevo_nev'];?>" size="50" /></td>
  </tr>

 <tr>
                        <td width = "150">Ország</td>  
<td><input type="text" name="vevo_orszag" placeholder="Ország" required value="<?php echo $row['vevo_orszag'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">Irányítószám</td>
<td><input type="text" id="irszam" name="vevo_irszam" placeholder="Irányítószám" required value="<?php echo $row['vevo_irszam'];?>" /></td>
</tr>
 <tr>
                        <td width = "150">Város</td>
<td><input type="text" id="telepulesek" name="vevo_varos" placeholder="Város" required value="<?php echo $row['vevo_varos'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">Utca neve</td>
<td><input type="text" name="vevo_utca" placeholder="Utca" required value="<?php echo $row['vevo_utca'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Közterület megnevezése (pl. út, utca)</td>
<td><input type="text" id="kozterulet_jellege" name="vevo_utca_megnevezes" placeholder="Közterület" required value="<?php echo $row['vevo_utca_megnevezes'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">Házszám</td>
<td><input type="text" name="vevo_utca_hazszam" placeholder="Házszám" required value="<?php echo $row['vevo_utca_hazszam'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">Épület</td>
<td><input type="text" name="vevo_epulet" placeholder="Épület" value="<?php echo $row['vevo_epulet'];?>" /></td>
</tr>

<tr>
                        <td width = "150">Lépcsőház</td>
<td><input type="text" name="vevo_lepcsohaz" placeholder="Lépcsőház" value="<?php echo $row['vevo_lepcsohaz'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">Emelet</td>
<td><input type="text" name="vevo_emelet" placeholder="Emelet" value="<?php echo $row['vevo_emelet'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">Ajtó</td>
<td><input type="text" name="vevo_ajto" placeholder="Ajtó" value="<?php echo $row['vevo_ajto'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">Adószám</td>
<td><input type="text" name="vevo_adoszam" placeholder="Adószám" value="<?php echo $row['vevo_adoszam'];?>" /></td>
</tr>

<tr>
                        <td width = "150">EU Adószám</td>
<td><input type="text" name="vevo_eu_adoszam" placeholder="EU Adószám" value="<?php echo $row['vevo_eu_adoszam'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">csasz</td>
<td><input type="text" name="vevo_csasz" placeholder="csasz" value="<?php echo $row['vevo_csasz'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">Bankszámlaszám</td>
<td><input type="text" size="50" name="vevo_bankszamla" placeholder="Bankszámlaszám" value="<?php echo $row['vevo_bankszamla'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">Email</td>
<td><input type="text" size="50" name="vevo_email" placeholder="Email" value="<?php echo $row['vevo_email'];?>" /></td>
</tr>


                        <td width = "150"></td>
<td><input name="submit" type="submit" value="Módosítás" /></td>
</tr></table>
</form>
<?php } ?>
</center>
</div>
</div>
</body>
</html>

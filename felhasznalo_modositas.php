<head>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/hu.messages.validate.js"> </script>
</head>
<body>
<style>
.error {
	color: red;
}
input[readonly] {  /* For IE */
			background-color: #F6F5FA;
			outline: none;
			border-color: #F6F5FA;
			 text-align: left;
			}

		input:-moz-read-only { /* For Firefox */
			background-color: #F6F5FA;
			outline: none;
			border-color: #F6F5FA;
			 text-align: left;
		}

		input:read-only { 
			background-color: #F6F5FA;
			//outline: none;
			//border-color: #F6F5FA;
			 text-align: left;
		}
</style>

<script>
$(document).ready(function () {

    $('#felhasznalo_form').validate({ // initialize the plugin
        rules: {
            felhasznalo_nev: {
                required: true,
				minlength: 2
            },
            felhasznalo_irszam: {
                required: true,
				   digits: true
            },
			  felhasznalo_varos: {
                required: true,
            },
			 felhasznalo_utca: {
                required: true,
            },
			felhasznalo_utca_megnevezes: {
                required: true,
            },
			felhasznalo_utca_hazszam: {
                required: true,
          	},
			felhasznalo_adoszam: {
                required: true,
          	}
        },
		submitHandler: function (form) {
            form.submit();
        },
		errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element); // default function
			//element.css('background', '#ffdddd');
			//element.css('border', '2px solid red');
        },

    });

});

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



  </script>	
<script language="javascript">
function onlyNumbers(x){
ki="";
   if (x >='0' && x <='9'){
      ki = x;
     }
return ki;
}

function adoszamCheck(adsz){
ki = "";
for(i=0; i < adsz.length; i++){
if(i != 8 && i != 10){
ki+= onlyNumbers(adsz.substr(i,1));
}else{
ki+="-";
}
}
if(ki.length == 8 || ki.length == 10 ){
ki+="-";
}
document.getElementById("adoszam").value = ki;
}
</script>
<?php 
require('config.php');
//include("auth.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);
$id=$_SESSION["user_id"];
$query = "SET NAMES UTF8"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
//$result = mysqli_query($con_rep, $query) or die ( mysql_error());
$query = "SELECT * from felhasznalok where user_id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
//$result = mysqli_query($con_rep, $query) or die ( mysql_error());
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
<h3>Saját adatok módosítása</h3>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_SESSION["user_id"];
$trn_date = date("Y-m-d H:i:s");
$felhasznalo_nev =$_REQUEST['felhasznalo_nev'];
$felhasznalo_orszag =$_REQUEST['felhasznalo_orszag'];
$felhasznalo_varos =$_REQUEST['felhasznalo_varos'];
$felhasznalo_irszam =$_REQUEST['felhasznalo_irszam'];
$felhasznalo_utca =$_REQUEST['felhasznalo_utca'];
$felhasznalo_utca_megnevezes =$_REQUEST['felhasznalo_utca_megnevezes'];
$felhasznalo_utca_hazszam =$_REQUEST['felhasznalo_utca_hazszam'];
$felhasznalo_epulet =$_REQUEST['felhasznalo_epulet'];
$felhasznalo_lepcsohaz =$_REQUEST['felhasznalo_lepcsohaz'];
$felhasznalo_emelet =$_REQUEST['felhasznalo_emelet'];
$felhasznalo_ajto =$_REQUEST['felhasznalo_ajto'];
$felhasznalo_adoszam =$_REQUEST['felhasznalo_adoszam'];
$felhasznalo_eu_adoszam =$_REQUEST['felhasznalo_eu_adoszam'];
$felhasznalo_csasz =$_REQUEST['felhasznalo_csasz'];
$felhasznalo_bankszamla =$_REQUEST['felhasznalo_bankszamla'];
$felhasznalo_email =$_REQUEST['felhasznalo_email'];
$felhasznalo_kata =$_REQUEST['felhasznalo_kata'];
$felhasznalo_status_code=$_SESSION['user_status'];
if ($_SESSION['user_first_invoice']=="1")
	{
	$felhasznalo_first_invoice = "";
	//átállítjuk a session státuszt üres mezőre
	$_SESSION['user_first_invoice']="";
	}
	else
	{
	$felhasznalo_first_invoice = $_SESSION['user_first_invoice'];
	}
//$submittedby = $_SESSION["username"];
$update="update felhasznalok set felhasznalo_nev='".$felhasznalo_nev."', felhasznalo_orszag='".$felhasznalo_orszag."', felhasznalo_varos='".$felhasznalo_varos."', felhasznalo_irszam='".$felhasznalo_irszam."', felhasznalo_utca='".$felhasznalo_utca."', felhasznalo_utca_megnevezes='".$felhasznalo_utca_megnevezes."', felhasznalo_utca_hazszam='".$felhasznalo_utca_hazszam."', felhasznalo_epulet='".$felhasznalo_epulet."', felhasznalo_lepcsohaz='".$felhasznalo_lepcsohaz."', felhasznalo_emelet='".$felhasznalo_emelet."', felhasznalo_ajto='".$felhasznalo_ajto."', felhasznalo_adoszam='".$felhasznalo_adoszam."', felhasznalo_eu_adoszam='".$felhasznalo_eu_adoszam."', felhasznalo_csasz='".$felhasznalo_csasz."', felhasznalo_bankszamla='".$felhasznalo_bankszamla."', felhasznalo_email='".$felhasznalo_email."', felhasznalo_kata='".$felhasznalo_kata."' , felhasznalo_first_invoice='".$felhasznalo_first_invoice."' , felhasznalo_status_code='".$felhasznalo_status_code."' where user_id='".$id."'";

mysqli_query($con, $update) or die(mysql_error());
$status = "Saját adatok módosítása megtörtént.  </br></br>";

echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<form name="form" method="post" action="" autocomplete="off" id="felhasznalo_form"> 
<table width = "600" border ="0" cellspacing = "1" cellpadding = "2">
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['table_line_id'];?>" />
                     <tr>
                        <td width = "170">Név / Cégnév</td>
<td>
	<?
	if ($row['felhasznalo_nev']=="")
	{
	?>
	<input type="text" name="felhasznalo_nev" placeholder="Név" value="<?php echo $row['felhasznalo_nev'];?>" size="50"  />
	<?
	}
	else
	{
	?>
	<input type="text" name="felhasznalo_nev" placeholder="Név" value="<?php echo $row['felhasznalo_nev'];?>" size="50" readonly>
	<?
	}
	?>
	</td>
  </tr>

 <tr>
                        <td width = "170">Ország</td>  
<td><input type="text" name="felhasznalo_orszag" placeholder="Ország" value="<?php echo $row['felhasznalo_orszag'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Város</td>
<td><input type="text" id="telepulesek" name="felhasznalo_varos" placeholder="Város" value="<?php echo $row['felhasznalo_varos'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Irányítószám</td>
<td><input type="text"  id="irszam" name="felhasznalo_irszam" placeholder="Irányítószám" value="<?php echo $row['felhasznalo_irszam'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Utca</td>
<td><input type="text" name="felhasznalo_utca" placeholder="Utca" value="<?php echo $row['felhasznalo_utca'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Közterület megnevezése (pl. út, utca)</td>
<td><input type="text" id="kozterulet_jellege" name="felhasznalo_utca_megnevezes" placeholder="Közterület" value="<?php echo $row['felhasznalo_utca_megnevezes'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Házszám</td>
<td><input type="text" name="felhasznalo_utca_hazszam" placeholder="Házszám" value="<?php echo $row['felhasznalo_utca_hazszam'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Épület</td>
<td><input type="text" name="felhasznalo_epulet" placeholder="Épület" value="<?php echo $row['felhasznalo_epulet'];?>" /></td>
</tr>

 <tr>
 <tr>
                        <td width = "170">Lépcsőház</td>
<td><input type="text" name="felhasznalo_lepcsohaz" placeholder="Lépcsőház" value="<?php echo $row['felhasznalo_lepcsohaz'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Emelet</td>
<td><input type="text" name="felhasznalo_emelet" placeholder="Emelet" value="<?php echo $row['felhasznalo_emelet'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Ajtó</td>
<td><input type="text" name="felhasznalo_ajto" placeholder="Ajtó" value="<?php echo $row['felhasznalo_ajto'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Adószám</td>
<td><input type="text" name="felhasznalo_adoszam" placeholder="Adószám" value="<?php echo $row['felhasznalo_adoszam'];?>" id="adoszam" onkeyup="adoszamCheck(this.value);" maxlength="13"/></td>
</tr>

                        <td width = "170">EU dószám</td>
<td><input type="text" name="felhasznalo_eu_adoszam" placeholder="EU Adószám" value="<?php echo $row['felhasznalo_eu_adoszam'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">csasz</td>
<td><input type="text" name="felhasznalo_csasz" placeholder="csasz" value="<?php echo $row['felhasznalo_csasz'];?>" /></td>
</tr>

 <tr>
                        <td width = "170">Bankszámlaszám</td>
<td><input type="text" size="50" name="felhasznalo_bankszamla" placeholder="Bankszámlaszám" value="<?php echo $row['felhasznalo_bankszamla'];?>" /></td>
</tr>

 <tr>
                        <td width = "200">Email </td>
<td><input type="text" size="50" name="felhasznalo_email" placeholder="Email" value="<?php echo $row['felhasznalo_email'];?>" /></td>
</tr>
	                        <td width = "150">Kisadózó vállalkozás (KATA)</td>
<td>
Igen<input type="radio" name="felhasznalo_kata" value="true" <?php if ($row['felhasznalo_kata']=="true") echo "checked";?>/>
Nem<input type="radio" name="felhasznalo_kata" value="false"<?php if ($row['felhasznalo_kata']!="true") echo "checked";?>/>
	</td>
</tr>


                        <td width = "150"></td>
<td><input name="submit" type="submit" value="Módosítás" /></td>
</tr></table>
</form>
<br><br>
Cégnév nem módosítható.<br>
	Amennyiben mégis módosítani szeretné akkor küldjön egy email-t a kszámla egyik <a href=https://kszamla.hu/kapcsolat/><font color=blue>elérhetőségére</font></a> és kollegáink 24 órán belül megváltoztatják.<br>
(Új cég esetén új fiókot kell regisztálni.)
<?php } ?>
</center>
</div>
</div>
</body>
</html>

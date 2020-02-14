<?php 
require('config.php');
include("auth.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
$id=$_REQUEST['id'];
$user_id = $_SESSION['user_id'];
$query = "SET NAMES UTF8"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
$query = "SELECT * from termekek where table_line_id='".$id."' and user_id = $user_id"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
$row = mysqli_fetch_assoc($result);
$termek_penznem = $row['termek_penznem'];
$termek_afa = $row['termek_afa'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<center>
	 <script>	
 		$(function(){
				  var afak = '<?php echo($termek_afa);?>';
				  var items="<option value='"+afak+"' selected>"+afak+"</option>";
				 
				  $.getJSON("afakulcs.php",function(data){

					$.each(data,function(index,item) 
					{
					  items+="<option value='"+item[2]+"'>"+item[2]+"</option>";
					});
					$("#afakulcs").html(items); 
					
				  });
		
				});
				
	$(function(){
				  var afak = '<?php echo($termek_penznem);?>';
				  var items="<option value='"+afak+"' selected>"+afak+"</option>";

				  $.getJSON("penznem.php",function(data){

					$.each(data,function(index,item) 
					{
					  items+="<option value='"+item[2]+"'>"+item[2]+"</option>";
					});
					$("#termek_penznem").html(items); 

				  });

				});
  </script>	

	
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$trn_date = date("Y-m-d H:i:s");
$termek_nev =$_REQUEST['termek_nev'];
$termek_netto_ar =$_REQUEST['termek_netto_ar'];
$termek_afa =$_REQUEST['termek_afa'];
$termek_penznem =$_REQUEST['termek_penznem'];
$termek_egyseg =$_REQUEST['termek_egyseg'];
$termek_kozv_szolg =$_REQUEST['termek_kozv_szolg'];
//$submittedby = $_SESSION["username"];
$update="update termekek set termek_nev='".$termek_nev."', termek_netto_ar='".$termek_netto_ar."', termek_afa='".$termek_afa."', termek_penznem='".$termek_penznem."', termek_egyseg='".$termek_egyseg."', termek_kozv_szolg='".$termek_kozv_szolg."' where table_line_id='".$id."' and user_id = $user_id";
mysqli_query($con, $update) or die(mysql_error());
Print ("Termék módosítás megtörtént.");
include("termek_lista.php");
}else {
?>
<div>
<h3>Termék módosítás</h3>
<form name="form" method="post" action="" autocomplete="off"> 
<table width = "600" border ="0" cellspacing = "1" cellpadding = "2">
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['table_line_id'];?>" />
                     <tr>
                        <td width = "150">Termék név</td>
<td><input type="text" name="termek_nev" placeholder="Termek nev" required value="<?php echo $row['termek_nev'];?>" size="50" /></td>
  </tr>

 <tr>
                        <td width = "150">Nettó ár</td>  
<td><input type="text" name="termek_netto_ar" placeholder="Termek netto ar" required value="<?php echo $row['termek_netto_ar'];?>" /></td>
</tr>

 <tr>
                        <td width = "150">Afa</td>
<td><select name="termek_afa" required value="<?php echo $row['termek_afa'];?>"  id="afakulcs"/>
<option value="<?php echo $row['termek_afa'];?>" selected><?php echo $row['termek_afa'];?></option></td>
</tr>

					 
					 <tr>
                        <td width = "150">Pénznem</td>
						   <td><select name="termek_penznem" required value="<?php echo $row['termek_afa'];?>"  id="termek_penznem"/>
							   <option value="<?php echo $row['termek_penznem'];?>" selected><?php echo $row['termek_penznem'];?></option></td>
					  </tr>

 <tr>
                        <td width = "150">Menny. egység</td>
<td><input type="text" name="termek_egyseg" placeholder="Termek egyseg" required value="<?php echo $row['termek_egyseg'];?>" /></td>
</tr>
                        <td width = "150"></td>
<tr>
	<td>
		Közvetített szolgáltatás:
	</td>
	<td>
		<input type="hidden" name="termek_kozv_szolg" value="" />
		<input type="checkbox" name="termek_kozv_szolg" value="true" <?php if ($row['termek_kozv_szolg']=="true") echo "checked";?>/>
	</td>
</tr>
<td><input name="submit" type="submit" value="Módosítás" /></td>
</tr></table>
</form>
<?php } ?>
</center>
</div>
</div>
</body>
</html>

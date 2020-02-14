<?php 
require('config.php');
//include("auth.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);
$id=$_REQUEST['id'];
$query = "SET NAMES UTF8"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
$query = "SELECT * from afakulcs where table_line_id='".$id."'"; 
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
<h3>Afakulcs módosítás</h3>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$trn_date = date("Y-m-d H:i:s");
$afa_nev =$_REQUEST['afa_nev'];
$afa_kulcs =$_REQUEST['afa_kulcs'];
//$submittedby = $_SESSION["username"];
$update="update afakulcs set afa_nev='".$afa_nev."', afa_kulcs='".$afa_kulcs."' where table_line_id='".$id."'";
mysqli_query($con, $update) or die(mysql_error());
$status = "Áfakulcs módosítás megtörtént. </br></br>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<form name="form" method="post" action=""> 
<table width = "600" border ="0" cellspacing = "1" cellpadding = "2">
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['table_line_id'];?>" />
                     <tr>
                        <td width = "150">Áfakulcs neve</td>
<td><input type="text" name="afa_nev" placeholder="Áfakulcs neve" required value="<?php echo $row['afa_nev'];?>" /></td>
  </tr>

 <tr>
                        <td width = "150">Afakulcs mértéke [%]</td>  
<td><input type="text" name="afa_kulcs" placeholder="Afakulcs mértéke [%]" required value="<?php echo $row['afa_kulcs'];?>" /></td>
</tr>

 <tr>
                       
                        <td width = "150"></td>
<td><input name="submit" type="submit" value="Módosítás" /></td>
</tr>
	</table>
</form>
<?php } ?>
</center>
</div>
</div>
</body>
</html>

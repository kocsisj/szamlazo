<?php 
require('config.php');
//include("auth.php");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
$id=$_SESSION["user_id"];
$query = "SET NAMES UTF8"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
$query = "SELECT * from felhasznalok where user_id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysql_error());
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css" />
</head>
<script>	


function checkPass()
{
    //Store the password field objects into variables ...
    var new_password = document.getElementById('new_password');
    var new_password_2nd = document.getElementById('new_password_2nd');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(new_password.value == new_password_2nd.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        new_password_2nd.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "A két jelszó megegyezik!"
		document.getElementById('submit').disabled = false;
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        new_password_2nd.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "A két jelszó nem egyezik meg!"
		document.getElementById('submit').disabled = true;
    }
}  
</script>
<body>
<div class="form">
<center>
<h3>Jelszó módosítás</h3>
<?php
$status = "";
if($_REQUEST['new_password'] != $_REQUEST['new_password_2nd'])
	{
	echo ("A két jelszó nem egyezik!");
	Break;
	}

if(isset($_POST['new']) && $_POST['new']==1)
{
$trn_date = date("Y-m-d H:i:s");
//$new_password =md5($_REQUEST['new_password']);
//$new_password = md5($password_salt.hash('sha512', $_REQUEST['new_password']));
$password_salt=md5($_REQUEST['new_password']);
$new_password = hash('sha512', $password_salt.$_REQUEST['new_password'].$password_salt);
$update="update felhasznalok set password='".$new_password."' where user_id='".$id."'";
mysqli_query($con, $update) or die(mysql_error());
$status = "Jelszó módosítás megtörtént. </br></br>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<form name="form" method="post" action=""> 
<table width = "600" border ="0" cellspacing = "1" cellpadding = "2">
<input type="hidden" name="new" value="1" />
<!--
<input name="id" type="hidden" value="<?php echo $row['password'];?>" />

					 <tr>
                        <td width = "150">Jelenlegi jelszó</td>
<td><input type="password" name="password" placeholder="Jelenlegi jelszó" required /></td>
  </tr>
-->
 <tr>

                        <td width = "150">Új jelszó</td>  
<td><input type="password" name="new_password" id="new_password" placeholder="Új jelszó" required  /></td>
</tr>

	<tr>
                        <td width = "150">Új jelszó mégegyszer</td>  
<td><input type="password" name="new_password_2nd" id="new_password_2nd" onkeyup="checkPass(); return false;" placeholder="Új jelszó mégegyszer" required  /></td>
</tr>
<tr>
                        <td width = "150"></td>  
<td><span id="confirmMessage" class="confirmMessage"></span></td>
</tr>


 <tr>

                        <td width = "150"></td>
<td><input name="submit" type="submit" id="submit" value="Módosítás" /></td>

</tr>
</table>
</form>
<?php } ?>
</center>
</div>
</div>
</body>
</html>

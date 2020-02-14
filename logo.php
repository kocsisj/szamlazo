<?php 
require('auth.php');
require('config.php');
$user_id = $_SESSION['user_id'];
$update="SELECT `felhasznalo_logo` FROM `felhasznalok` WHERE user_id='".$user_id."'";
$result=mysqli_query($con, $update) or die(mysql_error());
$row = mysqli_fetch_assoc($result);
$file = $row['felhasznalo_logo'];
//print($file);
?>
<html>
   <head>
   </head>
<body>
Jelenlegi logo:<br>
<img src="logo/<? echo $file ?>" height=71 alt="nincs logo"></img><br><br>
Új logo (max. méret 230x80 pixel):
   <form action="upload_file.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
	   <input type="hidden" name="menu" value="upload" />
      <input type="file" name="file"><br><br>
      <input type="submit" value=" Feltöltés ">
   </form>
   </font>
</body>
<html>
<script src="lib/alertify.min.js"></script>

<!-- include the core styles -->
<link rel="stylesheet" href="themes/alertify.core.css" />
<!-- include a theme, can be included into the core instead of 2 separate files -->
<link rel="stylesheet" href="themes/alertify.default.css" />
<?php 
require('auth.php');
require('config.php');
$user_id = $_SESSION['user_id'];
$target_dir = "/logo/";

$home_folder=$_SERVER['DOCUMENT_ROOT'];
			
$directory=$home_folder.$target_dir;

	if (!file_exists($directory)) {
		mkdir($directory, 0777, true);
	}
	$upload_folder=$_FILES['file']['name'];
	$ext = end((explode(".", $upload_folder)));
// logo userid+idő-vel
	$t=time();
	$upload_file_name=$user_id.$t.".".$ext;
// logo csak userid-vel
	//$upload_file_name=$user_id.".jpg";
if (move_uploaded_file($_FILES['file']['tmp_name'],  'logo/'.$upload_file_name)) {
    //echo "Logo feltoltva.\n";
	$update="update felhasznalok set felhasznalo_logo='".$upload_file_name."' where user_id='".$user_id."'";
mysqli_query($con, $update) or die(mysql_error());

} else {
    echo "Feltoltés hiba!\n";
}
?>
<html>
<head>
</head>
<body>
<script>
	//alertify.success('Logo feltoltve');
	window.location.href = "szamla.php?menu=logo";
	</script>
</body>
</html>

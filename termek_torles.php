<?php 
require('config.php');
$id=$_REQUEST['id'];
//echo $id;
$query = "DELETE FROM termekek WHERE table_line_id=$id"; 
$result = mysqli_query( $con, $query ) or die ( mysql_error());
 ?>
<script>
alertify.success ( "Termék Törölve" );
</script>





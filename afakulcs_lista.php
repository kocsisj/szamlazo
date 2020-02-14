	<div style="text-align:right"> 
		<br><a href="?menu=uafa" class="button"> + Új afakulcs hozzáadás </a><br><br>
        </div>
		
<script language="JavaScript" type="text/javascript">

/*
$(document).ready(function(){
$( ".buttonred" ).click(function() {

alertify.set({ labels: {
    ok     : "Igen",
    cancel : "Nem"
} });

var id=this.value
	alertify.confirm("Biztos hogy törlöd?", function (e) {
    if (e) {
        //alert(id);
		location.href = "?menu=tafa&id="+id;
    } else {
       //alert("nok");
    }
});

});
});
*/

function myFunction(id) {

	alertify.set({ labels: {
    ok     : "Igen",
    cancel : "Nem"
} });
alertify.set({ buttonReverse: true });
	 $("#menu_szelesseg").fadeTo("slow", 0.5);
  	 $("#oldal_szelesseg").fadeTo("slow", 0.5);
	alertify.confirm("Biztos hogy törlöd?", function (e) {
    if (e) {
        //alert(id);
		location.href = "?menu=tafa&id="+id;
    } else {
		$("#menu_szelesseg").fadeTo("slow", 1);
		$("#oldal_szelesseg").fadeTo("slow", 1);
       //alert("nok");
    }
});

}

</script>
<?php 
$user_id = $_SESSION['user_id'];
include_once('config.php'); 
error_reporting(E_ALL);
ini_set("display_errors", 1);

$tableName = "afakulcs";
$result = mysqli_query($con, "SELECT * FROM $tableName");
$total_results = mysqli_num_rows($result);

function mysqli_result($result, $row, $field = 0) {
    // Adjust the result pointer to that specific row
    $result->data_seek($row);
    // Fetch result array
    $data = $result->fetch_array();
 
    return $data[$field];
}
 echo "<center><table class='table table-bordered2'>";
 $user_id = $_SESSION['user_id'];
					echo "<thead><tr bgcolor=#787878 >";
                    //echo "<th>Table line id</th> <th>User ID</th>";
					 echo "<th>Áfa név</th>
					<th>Áfakulcs mértéke [%]</th>
					<th></th><th></th>
					</tr></thead>";
for ($i = 0; $i < $total_results; $i++) {
                        // make sure that PHP doesn't try to show results that don't exist
                        if ($i == $total_results) {
                            break;
                        }

// echo out the contents of each row into a table
				if ($user_id == mysqli_result($result, $i, 'user_id') or mysqli_result($result, $i, 'user_id')==0) {
                        echo "<tr bgcolor=white>";
                        //echo '<td>' . mysqli_result($result, $i, 'table_line_id') . '</td>';
                        //echo '<td>' . mysqli_result($result, $i, 'user_id') . '</td>';
						echo '<td>' . mysqli_result($result, $i, 'afa_nev') . '</td>';
						echo '<td>' . mysqli_result($result, $i, 'afa_kulcs') . '</td>';
						if ($user_id == mysqli_result($result, $i, 'user_id') or mysqli_result($result, $i, 'user_id')!=0) {
							echo '<td><a href=?menu=mafa&id=' .  mysqli_result($result, $i, 'table_line_id') . ' class="button">Módosít</a></td>';
							//Javascript valtozat
							echo '<td><button class="buttonred" onClick="myFunction(\'' . mysqli_result($result, $i, 'table_line_id')  . '\');">Töröl</button></td>'; 
							//Jquery változat
							//echo '<td><button value="' . mysqli_result($result, $i, 'table_line_id')  . '" class="buttonred">Töröl</button></td>';
							echo "</tr>";
							}
                    }   
					}
                    // close table>
                echo "</table></center>";						
?>



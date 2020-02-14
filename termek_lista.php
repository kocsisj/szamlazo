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
		location.href = "?menu=tt&id="+id;
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
		location.href = "?menu=tt&id="+id;
    } else {
		$("#menu_szelesseg").fadeTo("slow", 1);
		$("#oldal_szelesseg").fadeTo("slow", 1);
       //alert("nok");
    }
});

}

</script>

<?php
include_once('config.php');    //include of db config file
include ('paginate.php'); //include of paginat page
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
function mysqli_result($result, $row, $field = 0) {
    // Adjust the result pointer to that specific row
    $result->data_seek($row);
    // Fetch result array
    $data = $result->fetch_array();
 
    return $data[$field];
}
$user_id = $_SESSION['user_id'];
$per_page = 15;         // number of results to show per page
//$result = mysql_query("SET NAMES UTF8");
//$result = mysql_query("SELECT * FROM termekek");
$result = $con->query("SET NAMES UTF8");  // ez kell, hogy menjenek az ékezetek éá őű
$result = $con->query("SELECT * FROM termekek where user_id = $user_id ORDER BY termek_nev ASC");

if(isset($_POST['keres']) or isset($_GET['keres']) ) {

		if(isset($_POST['keres'])) {
			$keres = $_POST['keres'];
			}
			else
			{
			$keres = $_GET['keres'];
			}
	$result = $con->query("SELECT * FROM termekek where termek_nev LIKE '%".$keres."%' and user_id=$user_id ORDER BY termek_nev ASC");
}

$total_results = mysqli_num_rows($result);
$total_pages = ceil($total_results / $per_page);//total pages we going to have

//-------------if page is setcheck------------------//
$show_page=1; 
if (isset($_GET['page'])) {
    $show_page = $_GET['page'];             //it will telles the current page
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;              
        $end = $per_page;
    }
} else {
    // if page isn't set, show first set of results
    $start = 0;
    $end = $per_page;
}
// display pagination
$page = intval($_GET['page']);

$tpages=$total_pages;
if ($page <= 0)
    $page = 1;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style type="text/css">
.logo
{
    text-align: center;
}
.container{

}
</style>
</head>
<body>
    <div class="container" >
		<div style="text-align:right"> 
		<br><a href="?menu=ut" class="button"> + Új termék hozzáadás </a><br><br>
        </div>
		<div class="row">
			 <form name = "form" method = "post" action = "<?php $_PHP_SELF ?>" autocomplete="off">
			 <center>
				 <input name = "keres" type = "text" size="50" id = "keres" placeholder="Keresés terméknév alapján">
				 <input class="button" type = "submit" id = "keressub" value = "Keresés"><br><br>
			</form>
        </div>
        <div class="row">
            <div class="span13 offset0">
			<!-- 
                <div class="mini-layout">
				-->
                 <?php
                    $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages. "&keres=" . $keres;
                    // display data in table
                    echo "<table class='table table-bordered'>";
                    echo "<thead><tr bgcolor=#e8eef7 >";
					// echo "<th>Table line id</th> <th>User ID</th>";
					 echo "<th>Termék név</th><th>Nettó ár</th><th>Áfa</th><th>Pénznem</th><th>Menny. egység</th><th>Közvetített szolgáltaás</th><th></th><th></th></tr></thead>";
                    // loop through results of database query, displaying them in the table 
                    for ($i = $start; $i < $end; $i++) {
                        // make sure that PHP doesn't try to show results that don't exist
                        if ($i == $total_results) {
                            break;
                        }
                      
                        // echo out the contents of each row into a table
                        echo "<tr bgcolor=white>";
                        //echo '<td>' . mysqli_result($result, $i, 'table_line_id') . '</td>';
                        //echo '<td>' . mysqli_result($result, $i, 'user_id') . '</td>';
						echo '<td width=540px>' . mysqli_result($result, $i, 'termek_nev') . '</td>';
						echo '<td>' . mysqli_result($result, $i, 'termek_netto_ar') . '</td>';
						echo '<td>' . mysqli_result($result, $i, 'termek_afa') . '</td>';
						echo '<td>' . mysqli_result($result, $i, 'termek_penznem') . '</td>';
						echo '<td>' . mysqli_result($result, $i, 'termek_egyseg') . '</td>';
						//echo '<td>' . mysqli_result($result, $i, 'termek_kozv_szolg') . '</td>';
						if (mysqli_result($result, $i, 'termek_kozv_szolg')!="") echo '<td>Igen</td>';
						if (mysqli_result($result, $i, 'termek_kozv_szolg')=="") echo '<td></td>';
						echo '<td width=40px><a href=?menu=tm&id=' .  mysqli_result($result, $i, 'table_line_id') . ' class="button">Módosít</a></td>';
						//echo '<td><a href=?menu=tt&id=' .  mysqli_result($result, $i, 'table_line_id') . ' class="buttonred">Töröl</td>';
						//Javascript valtozat
						echo '<td width=40px><button class="buttonred" onClick="myFunction(\'' . mysqli_result($result, $i, 'table_line_id')  . '\');">Töröl</button></td>'; 
						//Jquery változat
						//echo '<td><button value="' . mysqli_result($result, $i, 'table_line_id')  . '" class="buttonred">Töröl</button></td>';
                        echo "</tr>";
                    }       
                    // close table>
                echo "</table>";
				if ($i == 0) {
				 echo "Nincs még egyetlen terméked sem. Jobb felső sarokban az <font color=blue>+Új termék hozzáadás</font> gombbal tudsz terméket hozzáadni.";
					}
            // pagination
			        echo '<div class="pagination"><ul>';
                    if ($total_pages > 1) {
						$menu='termek';
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
            ?>
				<!--
                  </div>
				-->
        </div>
    </div>
</div>
</body>
</html>




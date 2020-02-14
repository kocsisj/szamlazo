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
		location.href = "?menu=vt&id="+id;
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
		location.href = "?menu=vt&id="+id;
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
$per_page = 10;         // number of results to show per page
//$result = mysql_query("SET NAMES UTF8");
//$result = mysql_query("SELECT * FROM termekek");
$result = $con->query("SET NAMES UTF8");  // ez kell, hogy menjenek az ékezetek éá őű
$result = $con->query("SELECT * FROM vevok where user_id = $user_id ORDER BY vevo_nev ASC");

if(isset($_POST['keres']) or isset($_GET['keres']) ) {

		if(isset($_POST['keres'])) {
			$keres = $_POST['keres'];
			}
			else
			{
			$keres = $_GET['keres'];
			}
	$result = $con->query("SELECT * FROM vevok where vevo_nev LIKE '%".$keres."%' and user_id=$user_id ORDER BY vevo_nev ASC");
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

    <div class="container">
	
		<div style="text-align:right"> 
		<br><a href="?menu=uv" class="button"> + Új vevő hozzáadás </a><br><br>
        </div>
		
        <div class="row">
			  <form name = "form" method = "post" action = "<?php $_PHP_SELF ?>" autocomplete="off">
			 <center>
				 <input name = "keres" type = "text" size="50" id = "keres" placeholder="Keresés vevőnév alapján">
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
                    //echo "<th>Table line id</th> <th>User ID</th>";
					 echo "<th>Név</th>
					<th>Ország</th>
					<th>Cím</th>
					<th>Adószám</th>
					<th></th><th></th>
					</tr></thead>";
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
						echo '<td>' . mysqli_result($result, $i, 'vevo_nev') . '</td>';
						echo '<td>' . mysqli_result($result, $i, 'vevo_orszag') . '</td>';
						echo '<td>' . mysqli_result($result, $i, 'vevo_irszam') . ', ';
						echo ' '.mysqli_result($result, $i, 'vevo_varos') . ' ';
						echo ' '.mysqli_result($result, $i, 'vevo_utca') . ' ';
						echo ' '.mysqli_result($result, $i, 'vevo_utca_megnevezes') . ' ';
						echo ' '.mysqli_result($result, $i, 'vevo_utca_hazszam') . '. ';
						if (mysqli_result($result, $i, 'vevo_epulet')!="") echo '' . mysqli_result($result, $i, 'vevo_epulet') . ' épület ';
						if (mysqli_result($result, $i, 'vevo_lepcsohaz')!="") echo '' . mysqli_result($result, $i, 'vevo_lepcsohaz') . ' lph ';
						if (mysqli_result($result, $i, 'vevo_emelet')!="") echo '' . mysqli_result($result, $i, 'vevo_emelet') . '. emelet ';
						if (mysqli_result($result, $i, 'vevo_ajto')!="") echo '' . mysqli_result($result, $i, 'vevo_ajto') . ' ajtó </td>';;
						echo '<td>' . mysqli_result($result, $i, 'vevo_adoszam') . '</td>';
						//echo '<td>' . mysqli_result($result, $i, 'vevo_csasz') . '</td>';
						//echo '<td>' . mysqli_result($result, $i, 'vevo_email') . '</td>';
						//echo '<td><a href=termek_modosítas.php>Módosít</a></td>';
						//echo '<td><a href=termek_torles.php>Töröl</td>';
						echo '<td width=40px><a href=?menu=vm&id=' .  mysqli_result($result, $i, 'table_line_id') . ' class="button">Módosít</a></td>';
						//echo '<td><a href=?menu=vt&id=' .  mysqli_result($result, $i, 'table_line_id') . ' class="buttonred">Töröl</td>'; 
						//Javascript valtozat
						echo '<td width=40px><button class="buttonred" onClick="myFunction(\'' . mysqli_result($result, $i, 'table_line_id')  . '\');">Töröl</button></td>'; 
						//Jquery változat
						//echo '<td><button value="' . mysqli_result($result, $i, 'table_line_id')  . '" class="buttonred">Töröl</button></td>';
                        echo "</tr>";
                    }       
                    // close table>
                echo "</table>";
			if ($i == 0) {
				 echo "Nincs még egyetlen vevőd sem. Jobb felső sarokban az <font color=blue>+Új vevő hozzáadás</font> gombbal tudsz vevőt hozzáadni.";
					}
            // pagination
			        echo '<div class="pagination"><ul>';
                    if ($total_pages > 1) {
						$menu='vevo';
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
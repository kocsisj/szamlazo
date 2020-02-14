<script language="JavaScript" type="text/javascript">

function storno(id) {


	alertify.set({ labels: {
    ok     : "Igen",
    cancel : "Nem"
	} });
	alertify.set({ buttonFocus: "cancel" });
	alertify.set({ buttonReverse: true });
	 $("#menu_szelesseg").fadeTo("slow", 0.5);
  	 $("#oldal_szelesseg").fadeTo("slow", 0.5);
	alertify.confirm("Biztos hogy érvényteleníteni akarod a számlát?", function (e) {
    if (e) {
        //alert(id);
		location.href = "?menu=storno&szla_sorszam="+id;
    } else {
		$("#menu_szelesseg").fadeTo("slow", 1);
		$("#oldal_szelesseg").fadeTo("slow", 1);
       //alert("nok");
    }
});}

function email_send(id, email) {


	alertify.set({ labels: {
    ok     : "Igen",
    cancel : "Nem"
	} });
	alertify.set({ buttonFocus: "cancel" });
	alertify.set({ buttonReverse: true });
	 $("#menu_szelesseg").fadeTo("slow", 0.5);
  	 $("#oldal_szelesseg").fadeTo("slow", 0.5);
	alertify.confirm("Biztos hogy el akarod e-mailben küldeni a számlát?<br>Címzett: " + email, function (e) {
    if (e) {
        //alert(id);
		location.href = "szla_pdf3.php?szla_email=1&szla_sorszam="+id;
    } else {
		$("#menu_szelesseg").fadeTo("slow", 1);
		$("#oldal_szelesseg").fadeTo("slow", 1);
       //alert("nok");
    }
});}


		  	 
    $(function () {
        $("#datepicker").datepicker({
            //constrainInput: true,
            showOn: 'button',
            buttonText: 'Keresés dátum alapján',
			 minDate: new Date('2016/01/01'), 
        });
		$('#datepicker').change(function() {
			$('#keres').val($(this).val());
			 $("form").submit();
		});
    });
	
	


$(function() {
    $("td[colspan=8]").find("p").hide();
    $("table").click(function(event) {
        event.stopPropagation();
        var $target = $(event.target);
        if ( $target.closest("td").attr("colspan") > 1 ) {
            $target.slideUp();
        } else {
            $target.closest("tr").next().find("p").slideToggle();
        }                    
    });
});
</script>

<?php

include('config.php');    //include of db config file
require('auth.php');
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
$user_id = ($_SESSION['user_id']);
$per_page = 15;         // number of results to show per page
$result = $con->query("SET NAMES UTF8");  // ez kell, hogy menjenek az ékezetek éá őű
$result = $con->query("SELECT * FROM szla_fej where user_id='$user_id' ORDER BY szla_datum DESC, szla_sorszam DESC");

if(isset($_POST['keres']) or isset($_GET['keres']) ) {

		if(isset($_POST['keres'])) {
			$keres = $_POST['keres'];
			}
			else
			{
			$keres = $_GET['keres'];
			}
	$result = $con->query("SELECT * FROM szla_fej where (vevo_nev LIKE '%".$keres."%' or szla_sorszam LIKE '%".$keres."%' or szla_datum LIKE '%".$keres."%') and user_id='$user_id' ORDER BY szla_datum DESC, szla_sorszam DESC");
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
    <link rel="stylesheet" type="text/css" href="css/style2.css" />
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
		<div class="row">
			 <form name = "form" method = "post" action = "<?php $_PHP_SELF ?>" autocomplete="off">
			 <center>
				 <input name = "keres" type = "text" size="50" id = "keres" placeholder="Vevő név / számlasorszám / dátum alapján">
				 <input class="button" type = "submit" id = "keressub" value = "Keresés">
				 <input name = "datum" type = "hidden" id = "datepicker">
			</form>
        </div>
        <div class="row">
<!-- 
            <div class="span12 offset1">

                <div class="mini-layout">
				-->

                 <?php
                    $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages. "&keres=" . $keres;
                    // display data in table
                    echo "<table class='table table-bordered'>";
                    echo "<thead><tr bgcolor=#e8eef7 >";
					// echo "<th>Table line id</th> <th>User ID</th>";
					 echo "<th>Sorszám</th><th>Vevő név</th><th>Dátum</th><th>Nettó érték</th><th>Áfa erték</th><th>Bruttó értek</th><th>Nyomtatás</th><th>Küldés</th><th>Stornó</th></tr></thead>";

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
						//echo '<td>' . mysqli_result($result, $i, 'szla_sorszam') . '</td>';
					//blank ablakos pdf szémla megjelenés
						//echo '<td width=150px><img src="/szamla/pic/view-icon.png" height=22px  align="top"</img><a href=szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . ' class="szla_megnez" target="_blank" >'. mysqli_result($result, $i, 'szla_sorszam') .'</a></td>';
					//popup ablakos pdf számla megjelenés
						echo '<td width=150px><img src="/szamla/pic/view-icon.png" height=22px  align="top"</img><a href=szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . ' class="szla_megnez" target="popup" onclick=window.open("szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . '","name","width=800,height=800") >'. mysqli_result($result, $i, 'szla_sorszam') .'</a></td>';
						echo '<td>' . mysqli_result($result, $i, 'vevo_nev') . '</td>';
						echo '<td>' . mysqli_result($result, $i, 'szla_datum') . '</td>';
						// itt van megedva hogy hany tizedes legyen
						$devizanem=mysqli_result($result, $i, 'szla_devizanem');
						If  ($devizanem =="HUF")  $devizanem ="Ft";
						echo "<td style='text-align:right'>" . number_format(mysqli_result($result, $i, 'szla_total_netto'), 0, ".", " ")." ". $devizanem .'</td>';
						echo "<td style='text-align:right'>" . number_format(mysqli_result($result, $i, 'szla_total_afa'), 0, ".", " ")." ". $devizanem .'</td>';
						echo "<td style='text-align:right'>" . number_format(mysqli_result($result, $i, 'szla_total_brutto'), 0, ".", " ")." ". $devizanem .'</td>';

						//echo "<td style='text-align:right'>" . mysqli_result($result, $i, 'szla_total_netto'). '</td>';
						//echo "<td style='text-align:right'>" . mysqli_result($result, $i, 'szla_total_afa') . '</td>';
						//echo "<td style='text-align:right'>" . mysqli_result($result, $i, 'szla_total_brutto') . '</td>';
					//blank ablakos pdf szémla megjelenés
						//echo '<td width=100px><a href=szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . ' class="button" target="_blank" >Nyomtatás</a></td>';
					//popup ablakos pdf számla megjelenés
						echo '<td width=100px><a href=szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . ' class="button" target="popup" onclick=window.open("szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . '","name","width=800,height=800") >Nyomtatás</a></td>';
						//echo '<td width=40px><a href=szla_pdf3.php?szla_email=1&szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . ' class="buttongreen" target="_parent" title="Számla küldése emailben&#013;&#010;" ></a></td>';
						 if (mysqli_result($result, $i, 'vevo_email') != "") {
							  echo '<td width=40px><button title="Számla küldése emailben&#013;&#010;' . mysqli_result($result, $i, 'vevo_email'). '" class="buttongreen" onClick="email_send(\'' .  mysqli_result($result, $i, 'szla_sorszam') . '\', \'' .  mysqli_result($result, $i, 'vevo_email') . '\');">@email</button></td>';
						 }
						 else
						 {
							 echo '<td></td>'; 
						 }
						//Javascript valtozat
						if (mysqli_result($result, $i, 'szla_status') == "") {
						echo '<td width=100px><button class="buttonred" onClick="storno(\'' . mysqli_result($result, $i, 'szla_sorszam')  . '\');">Érvénytelenít</button></td>'; 
						  }
						  else
							{
						echo '<td></td>'; 
						  }
						echo "</tr>";
						// ez a lenyilo menu javascript bent van előkészítése, aktiváláskot valami miatt rés van a két sor között valószínű a css table td tr elemet formázását kell megnézni
						// echo "<tr><td colspan='8'><p>ah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah.</p></td></tr>";
						}

                    // close table>
                echo "</table>";
            // pagination
			        echo '<div class="pagination"><ul>';
                    if ($total_pages > 1) {
						//$menu='termek';
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
            ?>	<!--
                  </div>
				
        </div>
-->
    </div>
</div>
</body>
</html>
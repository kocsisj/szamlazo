<style>
	
input[type="checkbox"] {
			width: 20px;
			height: 20px;
			padding: 5em;
			border: 0px solid #369;
	 box-shadow:0 0 5px 0px lightgray inset;
			}

input[type='checkbox']:hover {
    box-shadow:0 0 5px 0px lightblue inset;
}

</style>
<script language="JavaScript" type="text/javascript">


function szamlakiallitas1(id) {


	alertify.set({ labels: {
    ok     : "Igen",
    cancel : "Nem"
	} });
	alertify.set({ buttonFocus: "cancel" });
	alertify.set({ buttonReverse: true });
	 $("#menu_szelesseg").fadeTo("slow", 0.5);
  	 $("#oldal_szelesseg").fadeTo("slow", 0.5);
	alertify.confirm("Biztos hogy számlát akarsz kiállítani a díjbekérő alapján?", function (e) {
    if (e) {
        //alert(id);
		location.href = "?menu=pro_szla_szamla&szla_sorszam="+id;
    } else {
		$("#menu_szelesseg").fadeTo("slow", 1);
		$("#oldal_szelesseg").fadeTo("slow", 1);
       //alert("nok");
    }
});}

function szamlakiallitas(id) {


//alert(id);
	 var content = '<center><form action="szamla.php" id="pro_szla_form"><table border=0>';
	content += '<div>Kérlek add meg a számla elkészítéséhez szükséges adatokat:</div>';
	content += '<div><input type="hidden" name="szla_sorszam" value="'+id+'"/></div>';
	content += '<div><input type="hidden" name="menu" value="pro_szla_szamla"/></div>';
    content += '<div><tr><td>Teljesítés dátuma: </td><td><input type="text" id="telj_datum" name="telj_datum" size="14"/></td><tr></div>';
	content += '<div><tr><td></td> <td>&nbsp</td><tr></div>';
    content += '<div><tr><td>Fizetési határidő: </td><td><input type="text" id="fiz_hatarido" name="fiz_hatarido" size="14"/></td><tr><br></div>';
	content += '<div><tr><td><br>"Penzügyi teljesítést nem igényel" felirat megjelenése a számlán: </td><td><br><input type="checkbox" id="szla_megjegyzes" name="szla_megjegyzes" value="fizetett" checked/></td><tr></div>';
	content += '<div><tr><td><br>Egyéb számlán megjelenő megjegyzés: </td><td></td><tr></div>';
	content += '<div><tr><td colspan="2"><textarea id="szla_megjegyzes_beirt" style="text-align:left" rows="3" cols="42" name="szla_megjegyzes_beirt" /></textarea></td><tr></div>';
	content += '<div><tr><td colspan="2"><br><center>A számla tartalma meg fog egyezni a díjbekérő tartalmával</center></td><tr></div>';
    content += '<div><tr><td colspan="2"><br><center><input type="submit" value="Elkészítem a számlát"/></center></td><tr></div></table>';

    $('#pro_szla_szamla_dialog').html(content).blur();
    $('#pro_szla_szamla_dialog').dialog({
        height: 620,
        width: 440,
        resizable: false,
        modal: true,
		title: "",
		open: function (event, ui) {
        $(".ui-widget-overlay").css({
            opacity: 0,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
		
    },
        draggable: true
    });



$(document).ready(function () {
	$('#telj_datum').blur().datepicker({
     	dateFormat: 'yy-mm-dd',
		minDate: -16,
		numberOfMonths: 1,
   	 }).on('change', function(){
        $('#szla_megjegyzes_beirt').select();  //IE miatt kell, hogy a datapicker ne nyiljon meg ismet kivalaszatas utan
    });

	$('#fiz_hatarido').blur().datepicker({
     	dateFormat: 'yy-mm-dd',
		minDate: 0,
		numberOfMonths: 1,
   	 }).on('change', function(){
        $('#szla_megjegyzes_beirt').select();   //IE miatt kell, hogy a datapicker ne nyiljon meg ismet kivalaszatas utan
    });
});


 $(document).ready(
		function () {	 
				//form submit esemény

		  $('#pro_szla_form').submit(function () {

				// Get the value and trim it
				var telj_datum = $.trim($('#telj_datum').val());
			  	var fiz_hatarido = $.trim($('#fiz_hatarido').val());

			    if (telj_datum  === '') {
				  alertify.alert('Nincs kitöltve a teljesítés dátuma ');
				  return false;
				  }
			  
			  if (fiz_hatarido  === '') {
				  alertify.alert('Nincs kitöltve a fizetési határidő ');
				  return false;
				  }
			});
			}
			);	

}
	





function email_send(id, email) {


	alertify.set({ labels: {
    ok     : "Igen",
    cancel : "Nem"
	} });
	alertify.set({ buttonFocus: "cancel" });
	alertify.set({ buttonReverse: true });
	 $("#menu_szelesseg").fadeTo("slow", 0.5);
  	 $("#oldal_szelesseg").fadeTo("slow", 0.5);
	alertify.confirm("Biztos hogy el akarod e-mailben küldeni a díjbekérőt?<br>Címzett: " + email, function (e) {
    if (e) {
        //alert(id);
		location.href = "pro_szla_pdf3.php?szla_email=1&szla_sorszam="+id;
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
$result = $con->query("SELECT * FROM pro_szla_fej where user_id='$user_id' ORDER BY szla_datum DESC, szla_sorszam DESC");

if(isset($_POST['keres']) or isset($_GET['keres']) ) {

		if(isset($_POST['keres'])) {
			$keres = $_POST['keres'];
			}
			else
			{
			$keres = $_GET['keres'];
			}
	$result = $con->query("SELECT * FROM pro_szla_fej where (vevo_nev LIKE '%".$keres."%' or szla_sorszam LIKE '%".$keres."%' or szla_datum LIKE '%".$keres."%') and user_id='$user_id' ORDER BY szla_datum DESC, szla_sorszam DESC");
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
	 echo "<th>Sorszám</th><th>Vevő név</th><th>Dátum</th><th>Nettó érték</th><th>Áfa erték</th><th>Bruttó értek</th><th>Nyomtatás</th><th>Küldés</th><th>Számlakiállítás</th></tr></thead>";

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
			//echo '<td width=150px><img src="/szamla/pic/view-icon.png" height=22px  align="top"</img> <a href=pro_szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . ' class="szla_megnez" target="_blank" >' . mysqli_result($result, $i, 'szla_sorszam') . '</a></td>';
		//popup ablakos pdf számla megjelenés
			echo '<td width=150px><img src="/szamla/pic/view-icon.png" height=22px  align="top"</img><a href=pro_szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . ' class="szla_megnez" target="popup" onclick=window.open("pro_szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . '","name","width=800,height=800") >'. mysqli_result($result, $i, 'szla_sorszam') .'</a></td>';
			echo '<td >' . mysqli_result($result, $i, 'vevo_nev') . '</td>';
			echo '<td>' . mysqli_result($result, $i, 'szla_datum') . '</td>';

			$devizanem=mysqli_result($result, $i, 'szla_devizanem');
			If  ($devizanem =="HUF")  $devizanem ="Ft";
			echo "<td style='text-align:right'>" . number_format(mysqli_result($result, $i, 'szla_total_netto'), 0, ".", " ")." ". $devizanem. '</td>';
			echo "<td style='text-align:right'>" . number_format(mysqli_result($result, $i, 'szla_total_afa'), 0, ".", " ")." ". $devizanem.'</td>';
			echo "<td style='text-align:right'>" . number_format(mysqli_result($result, $i, 'szla_total_brutto'), 0, ".", " ")." ".$devizanem. '</td>';

			//echo "<td style='text-align:right'>" . mysqli_result($result, $i, 'szla_total_netto'). '</td>';
			//echo "<td style='text-align:right'>" . mysqli_result($result, $i, 'szla_total_afa') . '</td>';
			//echo "<td style='text-align:right'>" . mysqli_result($result, $i, 'szla_total_brutto') . '</td>';
		//blank ablakos pdf számla megjelenés
			//echo '<td width=100px><a href=pro_szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . ' class="button" target="_blank" >Nyomtatás</a></td>';
		//popup ablakos pdf számla megjelenés
			echo '<td width=100px><a href=pro_szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . ' class="button" target="popup" onclick=window.open("pro_szla_pdf3.php?szla_sorszam=' .  mysqli_result($result, $i, 'szla_sorszam') . '","name","width=800,height=800") >Nyomtatás</a></td>';
			 if (mysqli_result($result, $i, 'vevo_email') != "") {
				echo '<td width=40px><button title="Számla küldése emailben&#013;&#010;' . mysqli_result($result, $i, 'vevo_email'). '" class="buttongreen" onClick="email_send(\'' .  mysqli_result($result, $i, 'szla_sorszam') . '\' , \'' .  mysqli_result($result, $i, 'vevo_email') . '\');">@email</button></td>';
				 }
			  else
				{
				echo '<td></td>'; 
			  }
			//Javascript valtozat
			 if (mysqli_result($result, $i, 'szla_status') == "") {
			echo '<td width=100px><button class="buttongreen" onClick="szamlakiallitas(\'' . mysqli_result($result, $i, 'szla_sorszam')  . '\');">Számlakiállítás</button></td>'; 
			  }
			  else
				{
			echo '<td></td>'; 
			  }
			echo "</tr>";
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
?>
<div id='pro_szla_szamla_dialog'></div>


    </div>
</div>
</body>
</html>
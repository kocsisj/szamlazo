<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.gvChart-1.0.min.js"></script>

<script>
		  $(function() {
			$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',   	 minDate: new Date('2016/01/01'),  });
			$( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd', 	 minDate: new Date('2016/01/01'),  maxDate: 0, });
		  });

</script>
	 <script>	


			  $(document).ready(

				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#termek_megnevezes").autocomplete({
						  /*Source refers to the list of fruits that are available in the auto complete list. */
						  //source:data,
						  source: 'termekek.php',
						  /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
						  it will be loaded in the textbox */
				     	 autoFocus: true ,
						 minLength: 1,
						 max:5,

					});
					$( "#termek_megnevezes").on( "autocompleteselect", function( event, ui ) {
						//alert(ui.item.value);
						value = ui.item.value.split(" | ");
						termek_megnevezes = value[0];
						
						$("#termek_megnevezes").val(termek_megnevezes);
						
						event.preventDefault();
					} );
				}  				  
				);

gvChartInit();
// dia1
$(document).ready(function() {
  jQuery('#tabla-1').gvChart({
    chartType: 'ColumnChart',
	hideTable: true,
    gvSettings: {
      vAxis: {title: 'Összeg'},
      hAxis: {title: 'Hónapok'},
      width: 900,
      height: 400,
    }
  });

});
// dia1

// dia2
$(document).ready(function() {
  jQuery('#tabla-2').gvChart({
    chartType: 'ColumnChart',
	hideTable: true,
    gvSettings: {
      vAxis: {title: 'Mennyiség'},
      hAxis: {title: 'Hónapok'},
	  colors: ['#339933', '#e6693e'],
      width: 900,
      height: 400,
    }
  });

});
// dia2

  </script>	
<?php 
include 'config.php';
require('auth.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);
//error_reporting( error_reporting() & ~E_NOTICE );

$honap_neve = array();
$havi_szamlaertek[] = array();
$havi_eladott_mennyiseg[] = array();


 if(isset($_POST['szur'])) {
	  
		$datum_tol = $_POST['datepicker_tol'];
		$datum_ig = $_POST['datepicker_ig'];
		$termek_megnevezes = $_POST['termek_megnevezes'];

		

	//$con = mysql_connect($dbHost,$dbUsername,$dbPassword);
	//$dbs = mysql_select_db($dbName, $con);
	$user_id = $_SESSION['user_id'];
	$tableName = "szla_tetel";

	// tetel lekérdezése
	$result = mysqli_query($con, "SET NAMES UTF8"); // ez kell, hogy menjenek az ékezetek éá őű
	 $result = mysqli_query($con, "SELECT * FROM $tableName  where user_id = '$user_id' and tetel_megnevezes = '$termek_megnevezes' and szla_datum BETWEEN '$datum_tol' and '$datum_ig' order by table_line_id asc ");

	$data = array();

	while ($row = $result->fetch_assoc()) {
		//$data[] = $row['felhasznalo_nev'].'|'.$row['felhasznalo_varos'];
		
		//termek adatainka kiolvasása
		$Q_termeknev = $row['tetel_megnevezes'];

		$Q_nettoar = $row['tetel_netto_ertek'];
		$Q_afakulcs = $row['tetel_afakulcs'];
		$Q_afaertek = $row['tetel_afaertek'];
		$Q_bruttoar = $row['tetel_brutto_ertek'];
		$Q_sorszam = $row['szla_sorszam'];
		$Q_kialldatum = $row['szla_datum'];

		$Q_datum = explode("-", $Q_kialldatum);
		$Q_ev = $Q_datum[0];
		$Q_honap = $Q_datum[1];
		$Q_nap = $Q_datum[2];

		//print($Q_honap);
		//print('-');
		//print($Q_bruttoar);
		//print("<br>");

		// ahonap neveit kigyűjtsük egy tombbe
		if (!in_array($Q_honap, $honap_neve))
			{
				$honap_neve[] = $Q_honap;

			}
		// létrehozzuk a gyűjtő tömbböt ha még nem létezne
		if (!array_key_exists($Q_honap, $havi_szamlaertek)) {
   				 $havi_szamlaertek[$Q_honap] =0;
			}

		$havi_szamlaertek[$Q_honap] = $havi_szamlaertek[$Q_honap]+ $Q_bruttoar;

		if (!array_key_exists($Q_honap, $havi_eladott_mennyiseg)) {
   				 $havi_eladott_mennyiseg[$Q_honap] =0;
			}
		$havi_eladott_mennyiseg[$Q_honap] = $havi_eladott_mennyiseg[$Q_honap]+ 1;

	}
	 //echo '<pre>';
	 //print_r($honap_neve);
	 //print_r($havi_szamlaertek);
	 //echo '</pre>';
// havi szamaosszesito adattatrtalmanak kiirasa

	$tomb_adatok_szama = count($honap_neve);
	// regi szoveges megjelenítés
	//for ($x = 0; $x < $tomb_adatok_szama  ; $x++) {
	//	print($tomb_adatok_szama);
	//	print(" - ");
	//	print($honap_neve[$x]);
	//	print(" - ");
	//	print($havi_szamlaertek[$honap_neve[$x]]);
	//	$havi_szamla_chart=$havi_szamlaertek[$honap_neve[$x]];
	//	print("<br>");
	//	}

print(" <table id='tabla-1'>
        <caption>$termek_megnevezes statisztika</caption>
        <thead>
          <tr>
            <th></th>");

for ($x = 0; $x < $tomb_adatok_szama  ; $x++) {

	 print("<th>$honap_neve[$x]</th>");
	}

	 print("</tr>
        </thead>");
print("<tbody>
          <tr>");
          print("<th>Havi számlázott</th>");
for ($x = 0; $x < $tomb_adatok_szama  ; $x++) {
	$havi_szamla_chart=$havi_szamlaertek[$honap_neve[$x]];
	print("<td>$havi_szamla_chart</td>");
}

   print("       </tr>
        </tbody>
      </table>
");
	 
print(" <table id='tabla-2'>
        <caption>$termek_megnevezes statisztika</caption>
        <thead>
          <tr>
            <th></th>");

for ($x = 0; $x < $tomb_adatok_szama  ; $x++) {

	 print("<th>$honap_neve[$x]</th>");
	}

	 print("</tr>
        </thead>");
print("<tbody>
          <tr>");
          print("<th>Havi eladott menny.</th>");
for ($x = 0; $x < $tomb_adatok_szama  ; $x++) {
	$havi_szamla_chart=$havi_eladott_mennyiseg[$honap_neve[$x]];
	print("<td>$havi_szamla_chart</td>");
}

   print("       </tr>
        </tbody>
      </table>
");

}else {
            ?>
			
               <form method = "post" action = "<?php $_PHP_SELF ?>" autocomplete="off">
			  <center>
			  <h3>Termek statisztika</h3>
                  <table width = "400" border ="0" cellspacing = "1" cellpadding = "2">
                     <tr>
                        <td width = "250">Termek megnevezes: </td>
                        <td ><input name = "termek_megnevezes" type = "text" id = "termek_megnevezes" size=50></td>
                    
                    
                     </tr>
					 
					 <tr>
                        <td width = "250">Dátumtól:</td>
                        <td><input name = "datepicker_tol" type = "text" id = "datepicker" ></td>
					 </tr>
					 <tr>
                        <td width = "250">Dátumig:</td>
                        <td><input name = "datepicker_ig" type = "text" value="<?php echo date('Y-m-d'); ?>" id = "datepicker2" ></td>
                     </tr>
                  
                     <tr>
                        <td width = "150"> </td>
                        <td> </td>
                     </tr>
                  
                     <tr>
                        <td width = "150"> </td>
						
                        <td>
                           <input name = "szur" type = "submit" id = "update" value = "Lekérdezés">
                        </td>
                     </tr>

                  </table> 
				  </center>
				  </form>
			 
            <?php
        }


?>

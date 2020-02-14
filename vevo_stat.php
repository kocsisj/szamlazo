<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.gvChart-1.0.min.js"></script>

<script>
		  $(function() {
			$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',   	 minDate: new Date('2016/01/01'),  });
			$( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd', 	 minDate: new Date('2016/01/01'), maxDate: 0, });
		  });

</script>
	 <script>	


			  $(document).ready(

				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#vevo_neve").autocomplete({
						  /*Source refers to the list of fruits that are available in the auto complete list. */
						  //source:data,
						  source: 'vevok.php',
						  /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
						  it will be loaded in the textbox */
				     	 autoFocus: true ,
						 minLength: 1,
						 max:5,

					});
					$( "#vevo_neve").on( "autocompleteselect", function( event, ui ) {
						//alert(ui.item.value);
						value = ui.item.value.split(" | ");
						vevo_nev = value[0];
						
						$("#vevo_neve").val(vevo_nev);
						
						event.preventDefault();
					} );
				}  				  
				);

gvChartInit();

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


  </script>	
<?php 
include 'config.php';
require('auth.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);
//error_reporting( error_reporting() & ~E_NOTICE );

$honap_neve = array();
$havi_szamlaertek[] = array();


 if(isset($_POST['szur'])) {
	  
		$datum_tol = $_POST['datepicker_tol'];
		$datum_ig = $_POST['datepicker_ig'];
		$vevo_neve = $_POST['vevo_neve'];
		
		

	//$con = mysql_connect($dbHost,$dbUsername,$dbPassword);
	//$dbs = mysql_select_db($dbName, $con);
	$user_id = $_SESSION['user_id'];
	$tableName = "szla_fej";

	// fejléc lekérdezése
	$result = mysqli_query($con, "SET NAMES UTF8"); // ez kell, hogy menjenek az ékezetek éá őű
	$result = mysqli_query($con, "SELECT * FROM $tableName where user_id = '$user_id' and vevo_nev = '$vevo_neve' and szla_datum BETWEEN '$datum_tol' and '$datum_ig' order by table_line_id asc ");
	
	$data = array();

	while ($row = $result->fetch_assoc()) {
		//$data[] = $row['felhasznalo_nev'].'|'.$row['felhasznalo_varos'];

		//eledo adatainka kiolvasása
		$Q_nev_elado = $row['felhasznalo_nev'];
		$Q_adoszam_elado = $row['felhasznalo_adoszam'];
		$Q_csasz_elado = $row['felhasznalo_csasz'];
		$Q_orszag_elado = $row['felhasznalo_orszag'];
		$Q_telepules_elado = $row['felhasznalo_varos'];
		$Q_irszam_elado = $row['felhasznalo_irszam'];
		$Q_korzetnev_elado = $row['felhasznalo_utca'];
		$Q_kozterjell_elado = $row['felhasznalo_utca_megnevezes'];
		$Q_hazszam_elado = $row['felhasznalo_utca_hazszam'];
		$Q_epulet_elado = $row['felhasznalo_epulet'];
		$Q_emelet_elado = $row['felhasznalo_emelet'];
		$Q_ajto_elado = $row['felhasznalo_ajto'];
		
		//vevő adatainak kiolvasása
		$Q_nev_vevo = $row['vevo_nev'];
		$Q_adoszam_vevo = $row['vevo_adoszam'];
		$Q_csasz_vevo = $row['vevo_csasz'];
		$Q_orszag_vevo = $row['vevo_orszag'];
		$Q_telepules_vevo = $row['vevo_varos'];
		$Q_irszam_vevo = $row['vevo_irszam'];
		$Q_korzetnev_vevo = $row['vevo_utca'];
		$Q_kozterjell_vevo = $row['vevo_utca_megnevezes'];
		$Q_hazszam_vevo = $row['vevo_utca_hazszam'];
		$Q_epulet_vevo = $row['vevo_epulet'];
		$Q_emelet_vevo = $row['vevo_emelet'];
		$Q_ajto_vevo = $row['vevo_ajto'];
		
		//szamlainfo adatainak kiolvasása
		$Q_sorszam = $row['szla_sorszam'];
		$Q_kialldatum = $row['szla_datum'];
		$Q_teljdatum = $row['szla_tejlesites_datum'];
		$Q_fizmod = $row['szla_fizetesi_mod'];
		$Q_fizhatarido = $row['szla_fizetesi_hatarido'];

		$Q_datum = explode("-", $Q_kialldatum);
		$Q_ev = $Q_datum[0];
		$Q_honap = $Q_datum[1];
		$Q_nap = $Q_datum[2];
		
		//szamla vegosszeg
		$Q_nettoarossz = $row['szla_total_netto'];
		$Q_afaertekossz = $row['szla_total_afa'];
		$Q_bruttoarossz = $row['szla_total_brutto'];

		//print($Q_honap);
		//print('-');
		//print($Q_bruttoarossz);
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
		$havi_szamlaertek[$Q_honap] = $havi_szamlaertek[$Q_honap]+ $Q_bruttoarossz;

		//$afa[$x]
		

// tételek lekérdezése
	//$query_tetel = "SELECT * FROM szla_tetel where user_id=$user_id and szla_sorszam='$Q_sorszam'"; 
	//$result_tetel = mysqli_query($con, $query_tetel);



		//$id=1;;


	//while ($row = $result_tetel->fetch_assoc()) {

		//	$Q_termeknev = $row['tetel_megnevezes'];

		//	$Q_nettoar = number_format($row['tetel_netto_ertek'], 2, ',', ' ');
		//	$Q_afakulcs = $row['tetel_afakulcs'];
		//	$Q_afaertek = number_format($row['tetel_afaertek'], 2, ',', ' ');
		//	$Q_bruttoar = number_format($row['tetel_brutto_ertek'], 2, ',', ' ');

		//	$id++;
		//}
		

	}
	 //echo '<pre>';
	 //print_r($honap_neve);
	 //print_r($havi_szamlaertek);
	 //echo '</pre>';
// havi szamaosszesito adattatrtalmanak kiirasa



	$tomb_adatok_szama = count($honap_neve);
	// regi szoveges megjelenítés
	//for ($x = 0; $x < $tomb_adatok_szama  ; $x++) {
	//	print($honap_neve[$x]);
	//	print(" - ");
	//	print($havi_szamlaertek[$honap_neve[$x]]);
	//	$havi_szamla_chart=$havi_szamlaertek[$honap_neve[$x]];
	//	print("<br>");
	//	}

print(" <table id='tabla-1'>
        <caption>$Q_nev_vevo vásárlási statisztika</caption>
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
          print("<th>Havi számlákösszeg</th>");
for ($x = 0; $x < $tomb_adatok_szama  ; $x++) {
	$havi_szamla_chart=$havi_szamlaertek[$honap_neve[$x]];
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
			  <h3>Vevő statisztika</h3>
                  <table width = "400" border ="0" cellspacing = "1" cellpadding = "2">
                     <tr>
                        <td width = "250">Vevő neve: </td>
                        <td ><input name = "vevo_neve" type = "text" id = "vevo_neve" size=30></td>
                    
                    
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

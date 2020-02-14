<script>
		  $(function() {
			$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',   	 minDate: new Date('2016/01/01'),  });
			$( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd', 	 minDate: new Date('2016/01/01'), });
		  });

</script>
<?php 
include 'config.php';
require('auth.php');
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
error_reporting( error_reporting() & ~E_NOTICE );
  $afa = array();
  $afa_ertek[] = array();
 if(isset($_POST['szur'])) {

		$kezdo_sorszam = $_POST['kezdo_sorszam'];
		$zaro_sorszam = $_POST['zaro_sorszam'];
		$datum_tol = $_POST['datepicker_tol'];
		$datum_ig = $_POST['datepicker_ig'];
		$xml = new DOMDocument('1.0', 'UTF-8');

	//$con = mysql_connect($dbHost,$dbUsername,$dbPassword);
	//$dbs = mysql_select_db($dbName, $con);
	$user_id = $_SESSION['user_id'];
	$tableName = "szla_fej";

	// fejléc lekérdezése
	$result = mysqli_query($con, "SET NAMES UTF8"); // ez kell, hogy menjenek az ékezetek éá őű
	$result = mysqli_query($con, "SELECT * FROM $tableName where (user_id = '$user_id') and ((szla_datum BETWEEN '$datum_tol' and '$datum_ig') or (szla_sorszam  BETWEEN '$kezdo_sorszam' and '$zaro_sorszam')) order by table_line_id asc ");
	 $rowcount=mysqli_num_rows($result);

	 print("Exportált számla darabszáma: "); print($rowcount); print("<br>");
	


	$data = array();
    $i=1;
	while ($row = $result->fetch_assoc()) {
		$szamla = $xml->createElement("szamla");
		$xml->appendChild($szamla);

		//elado adatainka kiolvasása
		$Q_nev_elado = $row['felhasznalo_nev'];
		$Q_adoszam_elado = $row['felhasznalo_adoszam'];
		$Q_adoszam_eu_elado = $row['felhasznalo_eu_adoszam'];
		$Q_csasz_elado = $row['felhasznalo_csasz'];
		$Q_orszag_elado = $row['felhasznalo_orszag'];
		$Q_telepules_elado = $row['felhasznalo_varos'];
		$Q_irszam_elado = $row['felhasznalo_irszam'];
		$Q_korzetnev_elado = $row['felhasznalo_utca'];
		$Q_kozterjell_elado = $row['felhasznalo_utca_megnevezes'];
		$Q_hazszam_elado = $row['felhasznalo_utca_hazszam'];
		$Q_epulet_elado = $row['felhasznalo_epulet'];
		$Q_lepcsohaz_elado = $row['felhasznalo_lepcsohaz'];
		$Q_emelet_elado = $row['felhasznalo_emelet'];
		$Q_ajto_elado = $row['felhasznalo_ajto'];
		$Q_kisadozo_elado = $row['felhasznalo_kata'];
		
		$Q_szla_penzforgelsz = $row['szla_penzforgelsz'];
		$Q_szla_onszamla = $row['szla_onszamla'];
		$Q_szla_ford_ado = $row['szla_ford_ado'];
		$Q_szla_adoment_hiv = $row['szla_adoment_hiv'];

		//vevő adatainak kiolvasása
		$Q_nev_vevo = $row['vevo_nev'];
		$Q_adoszam_vevo = $row['vevo_adoszam'];
		$Q_adoszam_eu_vevo = $row['vevo_eu_adoszam'];
		$Q_csasz_vevo = $row['vevo_csasz'];
		$Q_orszag_vevo = $row['vevo_orszag'];
		$Q_telepules_vevo = $row['vevo_varos'];
		$Q_irszam_vevo = $row['vevo_irszam'];
		$Q_korzetnev_vevo = $row['vevo_utca'];
		$Q_kozterjell_vevo = $row['vevo_utca_megnevezes'];
		$Q_hazszam_vevo = $row['vevo_utca_hazszam'];
		$Q_epulet_vevo = $row['vevo_epulet'];
		$Q_lepcsohaz_vevo = $row['vevo_lepcsohaz'];
		$Q_emelet_vevo = $row['vevo_emelet'];
		$Q_ajto_vevo = $row['vevo_ajto'];
		
		//szamlainfo adatainak kiolvasása
		$Q_sorszam = $row['szla_sorszam'];
		// elso sorszam elmentese
			if ($kezdo_sorszam=="" or $datum_tol=="") 
				{
				$kezdo_sorszam = $row['szla_sorszam'];
				$datum_tol = $row['szla_datum'];	
				}
			if ($i==$rowcount)
				{
				$zaro_sorszam = $row['szla_sorszam'];
				$datum_ig = $row['szla_datum'];	
				}
		$Q_kialldatum = $row['szla_datum'];		
		$Q_teljdatum = $row['szla_tejlesites_datum'];
		$Q_fizmod = $row['szla_fizetesi_mod'];
		$Q_fizhatarido = $row['szla_fizetesi_hatarido'];
		$Q_szla_status = $row['szla_status'];
		$Q_szamlatipusa = 1;
		if ($Q_szla_status=="ervenytelenito_szamla") $Q_szamlatipusa = 4;

		//$Q_hivatkozottszamla = $row['szla_hivatkozottszamla'];
		//$Q_egyebadat = $row['szla_egyebadat'];
		$Q_penznem = $row['szla_devizanem'];
		
		//szamla vegosszeg
		$Q_nettoarossz = $row['szla_total_netto'];
		$Q_afaertekossz = $row['szla_total_afa'];
		$Q_bruttoarossz = $row['szla_total_brutto'];

	// tételek lekérdezése
	$query_tetel = "SELECT * FROM szla_tetel where user_id=$user_id and szla_sorszam='$Q_sorszam'"; 
	$result_tetel = mysqli_query($con, $query_tetel);


	// xml fejléc létrehozása
	include("xml_fejlec.php");

	while ($row = $result_tetel->fetch_assoc()) {

			$Q_termeknev = $row['tetel_megnevezes'];
			$Q_tetel_kozv_szolg = $row['tetel_kozv_szolg'];
			$Q_tetel_mennyiseg = $row['tetel_mennyiseg'];
			$Q_tetel_mennyisegi_egyseg = $row['tetel_mennyisegi_egyseg'];
			$Q_tetel_netto_egysegar = $row['tetel_netto_egysegar'];
			$Q_nettoar = $row['tetel_netto_ertek'];
			$Q_afakulcs = $row['tetel_afakulcs'];
			$Q_afaertek = $row['tetel_afaertek'];
			$Q_bruttoar = $row['tetel_brutto_ertek'];

			include("xml_tetel.php");
			$id++;
		
			// tetel kiiras közbenn megcsinaljuk az afa osszesitot
			//ha tetel_afakulcs nulla akkor másképpen kell feldolgozni, átnevezzük null-ra, az osszesítoben forgatjuk majd vissza
				if ($row['tetel_afakulcs']== 0) 
				{
					$row['tetel_afakulcs'] = "null";	
				}
				
				if (!in_array($row['tetel_afakulcs'], $afa))
				{
					$afa[] = $row['tetel_afakulcs'];
				}

				$afa_netto_ertek[$row['tetel_afakulcs']] = $afa_netto_ertek[$row['tetel_afakulcs']] + $row['tetel_netto_ertek'];
				$afa_ertek[$row['tetel_afakulcs']] = $afa_ertek[$row['tetel_afakulcs']] + $row['tetel_afaertek'];
				$afa_brutto_ertek[$row['tetel_afakulcs']] = $afa_brutto_ertek[$row['tetel_afakulcs']] + $row['tetel_brutto_ertek'];
				
				//array_push($data, $name);	
		
		}

		// zaradekok
		$zaradekok = $xml->createElement("zaradekok");
		$szamla->appendChild($zaradekok);

		$penzforgelsz = $xml->createElement("penzforgelsz",$Q_szla_penzforgelsz);
		if ($Q_szla_penzforgelsz=="true") $zaradekok->appendChild($penzforgelsz);

		$onszamla = $xml->createElement("onszamla",$Q_szla_onszamla);
		if ($Q_szla_onszamla=="true") $zaradekok->appendChild($onszamla);

		$ford_ado = $xml->createElement("ford_ado",$Q_szla_ford_ado);
		if ($Q_szla_ford_ado=="true") $zaradekok->appendChild($ford_ado);

		$adoment_hiv = $xml->createElement("adoment_hiv",$Q_szla_adoment_hiv);
		if ($Q_szla_adoment_hiv=="true")$zaradekok->appendChild($adoment_hiv);


		// nem kotelezo elem
		$nem_kotelezo = $xml->createElement("nem_kotelezo");
		$szamla->appendChild($nem_kotelezo);

		$fiz_hatarido = $xml->createElement("fiz_hatarido",$Q_fizhatarido);
		$nem_kotelezo->appendChild($fiz_hatarido);

		$fiz_mod = $xml->createElement("fiz_mod",$Q_fizmod);
		$nem_kotelezo->appendChild($fiz_mod);

		$penznem = $xml->createElement("penznem",$Q_penznem);
		if ($Q_penznem!="") $nem_kotelezo->appendChild($penznem);


		include("xml_osszesito.php");
		// xml kiiras utan kitöröljük az afa összesítőt hogy tisztán induljunk a következő ciklusban
		unset($afa);
		$afa = array();
		
		unset($afa_netto_ertek);
		$afa_netto_ertek = array();
		
		unset($afa_ertek);
		$afa_ertek = array();
		
		unset($afa_brutto_ertek);
		$afa_brutto_ertek = array();
		$i++;
	}
	
	
		 $xml->FormatOutput =true;
		 $string_value = $xml->saveXML();
		  $xml->save('xmlnav/'.$user_id.'-2.xml');
		  
		  print("Kezdo szla szam: "); print($kezdo_sorszam); print("<br>"); 
		  print("Zaro szla szam: "); print($zaro_sorszam); print("<br>");
		  print("Kezdo ido: "); print($datum_tol); print("<br>");
	      print("Zaro ido: "); print($datum_ig); print("<br>");
		
	// fejléc elkészítése
		$xml_fej = new DOMDocument('1.0', 'UTF-8');
		
		$element = $xml_fej->createElementNS('http://schemas.nav.gov.hu/2013/szamla', 'szamlak', '');

		$xml_fej->appendChild($element);

		$datum_x = $xml_fej->createElement("export_datuma",date('Y-m-d'));
		$element->appendChild($datum_x);

		$rowcount_x = $xml_fej->createElement("export_szla_db",$rowcount);
		$element->appendChild($rowcount_x);

		$datum_tol_x = $xml_fej->createElement("kezdo_ido",$datum_tol);
		$element->appendChild($datum_tol_x);
		$datum_ig_x = $xml_fej->createElement("zaro_ido",$datum_ig);
		$element->appendChild($datum_ig_x);	
			
		$kezdo_sorszam_x = $xml_fej->createElement("kezdo_szla_szam",$kezdo_sorszam);
		$element->appendChild($kezdo_sorszam_x);
		$zaro_sorszam_x = $xml_fej->createElement("zaro_szla_szam",$zaro_sorszam);
		$element->appendChild($zaro_sorszam_x);
		

		$xml_fej->FormatOutput =true;
	 	


		$string_value = $xml_fej->saveXML();
		$xml_fej->save('xmlnav/'.$user_id.'.xml');

		//szamlak záró element törlése az fejléc fileból
		$file1 = file_get_contents('xmlnav/'.$user_id.'.xml');
	 	$fp1 = fopen('xmlnav/'.$user_id.'.xml', 'w');
	 	$file1 = str_replace('</szamlak>', '', $file1);
		fwrite($fp1, $file1);

	 	// megnyitjuk és osszefűzzők a xml_fejet a szamlatartalommal
	 	$fp1 = fopen('xmlnav/'.$user_id.'.xml', 'a+');
		$file2 = file_get_contents('xmlnav/'.$user_id.'-2.xml');

		$lines = explode("\n", $file2);
		$skipped_content = implode("\n", array_slice($lines, 1));

		fwrite($fp1, $skipped_content);
		
	 	//szamlak záró elementet visszatesszük a file végére
		$file_data = file_get_contents('xmlnav/'.$user_id.'.xml');
		$file_data .= "</szamlak>";
		file_put_contents('xmlnav/'.$user_id.'.xml', $file_data);

		
		print("<center><br>A fájl elkészült<br><br>");
		print("<a href='xml_letoltes.php?file=xmlnav/$user_id.xml' class='button' download>Letöltés</a><center><br><br>");
 
}else {
            ?>
			
               <form method = "post" action = "<?php $_PHP_SELF ?>" autocomplete="off">
			  <center>
			  <h3>Adóhatósági ellenőrző adatszolgáltatás</h3>
                  <table width = "600" border ="0" cellspacing = "1" cellpadding = "2">
                     <tr>
                        <td width = "250">Kezdő sorszám:</td>
                        <td ><input name = "kezdo_sorszam" type = "text" id = "kezdo_sorszam"></td>
                    
                        <td width = "250">Záró sorszám:</td>
                        <td><input name = "zaro_sorszam" type = "text" id = "zaro_sorszam" ></td>
                     </tr>
					 
					 <tr>
                        <td width = "250">Dátumtól:</td>
                        <td><input name = "datepicker_tol" type = "text" id = "datepicker" ></td>
                   
                        <td width = "250">Dátumig:</td>
                        <td><input name = "datepicker_ig" type = "text" id = "datepicker2" ></td>
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

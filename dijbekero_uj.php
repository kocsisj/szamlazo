<html>
   
   <head>
 


   </head>
   
   <body>
      <?php
		//error_reporting(E_ALL);
		//ini_set("display_errors", 1);
			require_once 'config.php';		
			//require_once 'felhasznalo_adatok.php';
            if(! $con ) {
               die('Could not connect: ' . mysql_error());
            }

       //felhazsnalo adatainek kiolvasasa     
			$id=$_SESSION["user_id"];
			$query = "SET NAMES UTF8"; 
			$result = mysqli_query($con, $query) or die ( mysql_error());
			$query = "SELECT * from felhasznalok where user_id='".$id."'"; 
			$result = mysqli_query($con, $query) or die ( mysql_error());
			$row = mysqli_fetch_assoc($result);

			$felhasznalo_nev = $row['felhasznalo_nev'];
			$felhasznalo_orszag = $row['felhasznalo_orszag'];
			$felhasznalo_varos = $row['felhasznalo_varos'];
			$felhasznalo_irszam = $row['felhasznalo_irszam'];
			$felhasznalo_utca = $row['felhasznalo_utca'];
			$felhasznalo_utca_megnevezes = $row['felhasznalo_utca_megnevezes'];
			$felhasznalo_utca_hazszam = $row['felhasznalo_utca_hazszam'];
			$felhasznalo_epulet = $row['felhasznalo_epulet'];
			$felhasznalo_lepcsohaz = $row['felhasznalo_lepcsohaz'];
			$felhasznalo_emelet = $row['felhasznalo_emelet'];
			$felhasznalo_ajto = $row['felhasznalo_ajto'];
			$felhasznalo_adoszam = $row['felhasznalo_adoszam'];
			$felhasznalo_eu_adoszam = $row['felhasznalo_eu_adoszam'];
			$felhasznalo_csasz = $row['felhasznalo_csasz'];
			$felhasznalo_bankszamla = $row['felhasznalo_bankszamla'];
			$felhasznalo_email = $row['felhasznalo_email'];
			$felhasznalo_kata = $row['felhasznalo_kata'];
			$felhasznalo_logo = $row['felhasznalo_logo'];
			
		// vevő adatai	
			$trn_date = date("Y-m-d H:i:s");
			$user_id =$_SESSION['user_id'];
			$vevo_nev =$_POST['cim'][0];
			$vevo_orszag =$_POST['cim'][1];
			$vevo_irszam =$_POST['cim'][2];
			$vevo_varos =$_POST['cim'][3];
			$vevo_utca =$_POST['cim'][4];
			$vevo_utca_megnevezes =$_POST['cim'][5];
			$vevo_utca_hazszam =$_POST['cim'][6];
			$vevo_epulet =$_POST['cim'][7];
			$vevo_lepcsohaz =$_POST['cim'][8];
			$vevo_emelet =$_POST['cim'][9];
			$vevo_ajto =$_POST['cim'][10];
			$vevo_adoszam =$_POST['cim'][11];
			$vevo_eu_adoszam =$_POST['cim'][12];
			$vevo_csasz =$_POST['cim'][13];
			$vevo_bankszamla =$_POST['cim'][14];
			$vevo_email =$_POST['cim'][15];
		//szamla adatai
			$szla_datum = $_POST['szamla_fejlec'][0];
			$szla_teljesites_datum = $_POST['szamla_fejlec'][1];
			$szla_fizetesi_hatarido = $_POST['szamla_fejlec'][2];
			$szla_fizetesi_mod = $_POST['szamla_fejlec'][3];	
			$szla_devizanem = $_POST['szamla_fejlec'][4];
			$szla_megjegyzes =$_POST['szamla_megjegyzes'];
			$szla_total_netto = $_POST['szamla_sum'][0];
			$szla_total_afa = $_POST['szamla_sum'][1];
			$szla_total_brutto = $_POST['szamla_sum'][2];
			$szla_email = $_POST['szla_email'];
			$szla_egysegar_tipus = $_POST['szamla_egysegar_tipus'];

		// szamla szam generalas és beallitott megjegyzesek
			//elotag és megjegyzések
			$select="SELECT * FROM pro_szla_beallitasok where user_id=$id";
			$result = mysqli_query( $con, $select );
			$row = mysqli_fetch_assoc($result);
			$szla_elotag = $row['szla_elotag'];
			$szla_megjegyzes_set = $row['szla_megjegyzes'];
			//xml-hez szükséges adatok
			$szla_penzforgelsz = $row['szla_penzforgelsz'];
			$szla_onszamla = $row['szla_onszamla'];
			$szla_ford_ado = $row['szla_ford_ado'];
			$szla_adoment_hiv = $row['szla_adoment_hiv'];

		//ha létezik a megjegyzes tipus akkor hozzáadunk egy sortörést a végéhez, hogy össze tudjuk őket fűzni
			if ($row['szla_penzforgelsz']=="true") $szla_penzforgelsz_szoveg = "Pénzforgalmi elszámolás."."\n";
			if ($row['szla_onszamla']=="true") $szla_onszamla_szoveg = "Önszámlázás."."\n";
			if ($row['szla_ford_ado']=="true") $szla_ford_ado_szoveg = "Fordított adózás."."\n";
			if ($row['szla_adoment_hiv']=="true") $szla_adoment_hiv_szoveg = "Alanyi adómentes vállalkozás."."\n";
			if ($szla_megjegyzes_set!="") $szla_megjegyzes_set = $szla_megjegyzes_set."\n";
			if ($_POST['szamla_megjegyzes']!="") $szla_megjegyzes_beirt = $szla_megjegyzes."\n";

			$szla_megjegyzes = $szla_megjegyzes_set.$szla_penzforgelsz_szoveg.$szla_onszamla_szoveg.$szla_ford_ado_szoveg.$szla_adoment_hiv_szoveg.$szla_megjegyzes;


			//ha nincs beállítva előtag akkor automatikusan az PRO+év lesz
				if ($szla_elotag=="") 
					{
					$szla_elotag = "PRO".date("Y");
					$insert="INSERT INTO pro_szla_beallitasok (user_id, szla_elotag) VALUES ('$id', '$szla_elotag')";
					$result = $con->query($insert) or die(mysql_error());;					
					}
			//szam
			$select="SELECT MAX(szla_szam) AS max_szla_szam FROM pro_szla_fej where user_id='$id' and szla_elotag='$szla_elotag'";
			$result = mysqli_query( $con, $select );
			$row = mysqli_fetch_assoc($result);
			$szla_szam = $row['max_szla_szam'];
			$szla_szam = $szla_szam +1;
			$szla_szam = sprintf('%06d', $szla_szam);
			$szla_sorszam = $szla_elotag."/".$szla_szam;
		
			$sql = "SET NAMES UTF8";
			$retval = mysqli_query( $con, $sql );
			$sql = "INSERT INTO `pro_szla_fej` (`table_line_id` , `user_id`, `felhasznalo_nev`, `felhasznalo_orszag`, `felhasznalo_varos`, `felhasznalo_irszam`, `felhasznalo_utca`, `felhasznalo_utca_megnevezes`, `felhasznalo_utca_hazszam`, `felhasznalo_epulet`, `felhasznalo_lepcsohaz`, `felhasznalo_emelet`, `felhasznalo_ajto`, `felhasznalo_adoszam`, `felhasznalo_eu_adoszam`,`felhasznalo_bankszamla`,  `felhasznalo_csasz`, `felhasznalo_email`, `felhasznalo_kata`, `vevo_nev`, `vevo_orszag`, `vevo_varos`, `vevo_irszam`, `vevo_utca`, `vevo_utca_megnevezes`, `vevo_utca_hazszam`, `vevo_epulet`,  `vevo_lepcsohaz`, `vevo_emelet`, `vevo_ajto`, `vevo_adoszam`, `vevo_eu_adoszam`, `vevo_bankszamla`, `vevo_csasz`, `vevo_email`, `szla_datum`, `szla_tejlesites_datum`, `szla_fizetesi_hatarido`, `szla_fizetesi_mod`, `szla_total_netto`, `szla_total_afa`, `szla_total_brutto`, `szla_megjegyzes`,`szla_penzforgelsz`,`szla_onszamla`,`szla_ford_ado`,`szla_adoment_hiv`, `szla_elotag`, `szla_szam`, `szla_sorszam`, `szla_devizanem`, `szla_logo`) VALUES (NULL, '$user_id', '$felhasznalo_nev', '$felhasznalo_orszag', '$felhasznalo_varos', '$felhasznalo_irszam', '$felhasznalo_utca', '$felhasznalo_utca_megnevezes', '$felhasznalo_utca_hazszam', '$felhasznalo_epulet', '$felhasznalo_lepcsohaz', '$felhasznalo_emelet', '$felhasznalo_ajto', '$felhasznalo_adoszam', '$felhasznalo_eu_adoszam', '$felhasznalo_bankszamla', '$felhasznalo_csasz', '$felhasznalo_email', '$felhasznalo_kata', '$vevo_nev', '$vevo_orszag', '$vevo_varos', '$vevo_irszam', '$vevo_utca', '$vevo_utca_megnevezes', '$vevo_utca_hazszam', '$vevo_epulet', '$vevo_lepcsohaz', '$vevo_emelet', '$vevo_ajto', '$vevo_adoszam', '$vevo_eu_adoszam', '$vevo_bankszamla', '$vevo_csasz', '$vevo_email', '$szla_datum', '$szla_teljesites_datum', '$szla_fizetesi_hatarido', '$szla_fizetesi_mod', '$szla_total_netto', '$szla_total_afa', '$szla_total_brutto', '$szla_megjegyzes','$szla_penzforgelsz','$szla_onszamla','$szla_ford_ado','$szla_adoment_hiv', '$szla_elotag', '$szla_szam', '$szla_sorszam', '$szla_devizanem', '$felhasznalo_logo');";
			
            $retval = mysqli_query( $con, $sql );
            
            if(! $retval ) {
               die('Could not update data: ' . mysqli_error($con));
            }
		//	számla tételek
			$sql = "SET NAMES UTF8";
			$retval = mysqli_query( $con, $sql );
			$tombsor = sizeof($_POST['szamla_tetel_nev'])-1;
			for ($i = 0; $i <= $tombsor; $i++) {
					$tetel_megnevezes = ($_POST['szamla_tetel_nev'][$i]);
					$tetel_mennyiseg = ($_POST['szamla_tetel_mennyiseg'][$i]);
					$tetel_mee = ($_POST['szamla_tetel_mee'][$i]);		
					$tetel_afakulcs = ($_POST['szamla_tetel_afa'][$i]);	
					if ($szla_egysegar_tipus=="brutto")
						{
						$tetel_netto_egysegar = ($_POST['szamla_tetel_egysegar'][$i]);	
						$tetel_netto_egysegar = $tetel_netto_egysegar / ((100 + $tetel_afakulcs)/100);
						} 
						else
						{
						$tetel_netto_egysegar = ($_POST['szamla_tetel_egysegar'][$i]);	
						} 
					
					$tetel_afa_nev = ($_POST['szamla_tetel_afa_nev'][$i]);				
					$tetel_netto_ertek = ($_POST['szamla_tetel_nettoertek'][$i]);				
					$tetel_afaertek = ($_POST['szamla_tetel_afaertek'][$i]);				
					$tetel_brutto_ertek = ($_POST['szamla_tetel_bruttoertek'][$i]);
					$tetel_kozv_szolg = ($_POST['szamla_tetel_kozv_szolg'][$i]);

			$sql = "INSERT INTO `pro_szla_tetel` (`table_line_id` , `user_id`, `tetel_megnevezes`, `tetel_kozv_szolg`, `tetel_mennyiseg`, `tetel_mennyisegi_egyseg`, `tetel_netto_egysegar`, `tetel_afakulcs`, `tetel_afa_nev`, `tetel_netto_ertek`, `tetel_afaertek`, `tetel_brutto_ertek`, `szla_elotag`, `szla_szam`, `szla_sorszam`, `szla_datum`) VALUES (NULL, '$user_id', '$tetel_megnevezes', '$tetel_kozv_szolg', '$tetel_mennyiseg', '$tetel_mee', '$tetel_netto_egysegar', '$tetel_afakulcs', '$tetel_afa_nev', '$tetel_netto_ertek', '$tetel_afaertek', '$tetel_brutto_ertek', '$szla_elotag', '$szla_szam', '$szla_sorszam', '$szla_datum');";
			
			$retval = mysqli_query( $con, $sql );
            
            if(! $retval ) {
               die('Could not update data: ' . mysqli_error($con));
			} 	
			} 	
            mysqli_close($con);


      ?>

   </body>
</html>
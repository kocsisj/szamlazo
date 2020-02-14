<?php  
require('auth.php');
include('config.php');    //include of db config file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$username = ($_SESSION['username']);
$user_id=$_SESSION["user_id"];

// szamla szam generalas és beallitott megjegyzesek
			//elotag és megjegyzések
			$select="SELECT * FROM szla_beallitasok where user_id=$user_id";
			$result = mysqli_query( $con, $select );
			$row = mysqli_fetch_assoc($result);
			$szla_elotag = $row['szla_elotag'];
			$szla_megjegyzes_set = $row['szla_megjegyzes'];
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

			$szla_megjegyzes_beallitott = $szla_megjegyzes_set.$szla_penzforgelsz_szoveg.$szla_onszamla_szoveg.$szla_ford_ado_szoveg.$szla_adoment_hiv_szoveg.$szla_megjegyzes;

			//szam
			$select="SELECT MAX(szla_szam) AS max_szla_szam FROM szla_fej where user_id='$user_id' and szla_elotag='$szla_elotag'";
			$result = mysqli_query( $con, $select );
			$row = mysqli_fetch_assoc($result);
			$szla_szam = $row['max_szla_szam'];
			$szla_szam = $szla_szam +1;
			$szla_szam = sprintf('%06d', $szla_szam);
			$szla_sorszam_s = $szla_elotag."/".$szla_szam;   //az uj  számla számlaszáma



//dijbekero_sorszam
$szla_sorszam = $_REQUEST['szla_sorszam'];
$telj_datum = $_REQUEST['telj_datum'];
$fiz_hatarido = $_REQUEST['fiz_hatarido'];

$szla_megjegyzes = $_REQUEST['szla_megjegyzes'];
$szla_megjegyzes_beirt = $_REQUEST['szla_megjegyzes_beirt'];

$szla_megjegyzes_text = "Penzügyi teljesítést nem igényel";

	If  ($szla_megjegyzes =="fizetett" and $szla_megjegyzes_beirt!="")  
	{
	$szla_megjegyzes = $szla_megjegyzes_text."\n".$szla_megjegyzes_beirt."\n".$szla_megjegyzes_beallitott;
    }
	elseif ($szla_megjegyzes =="fizetett" and $szla_megjegyzes_beirt=="")
	{
	$szla_megjegyzes = $szla_megjegyzes_text."\n".$szla_megjegyzes_beallitott;
    }
	elseif ($szla_megjegyzes !="fizetett" and $szla_megjegyzes_beirt!="")
	{
	$szla_megjegyzes = $szla_megjegyzes_beirt."\n".$szla_megjegyzes_beallitott;
    }
	else
	{
	$szla_megjegyzes = "".$szla_megjegyzes_beallitott;
    }

//számla fejléc query
//$query = "SET NAMES cp1250"; 
//$result = mysqli_query($con, $query);

$sql = "SET NAMES UTF8";
$retval = mysqli_query( $con, $sql );

$query = "CREATE TEMPORARY TABLE tmp_pro_fej SELECT * FROM pro_szla_fej WHERE user_id=$user_id and szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_pro_fej SET table_line_id='null' WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_pro_fej SET szla_total_netto = szla_total_netto,  szla_total_afa = szla_total_afa, szla_total_brutto = szla_total_brutto WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);
// itt hozzáadjuk a megjegyzésbe az eredeti szamla sorszámot
$query = "UPDATE tmp_pro_fej SET szla_megjegyzes=CONCAT_WS('', '$szla_megjegyzes','Díjbekérő sorszáma: $szla_sorszam \n', szla_megjegyzes ) WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$datum = date('Y-m-d');
$query = "UPDATE tmp_pro_fej SET szla_datum = '$datum', szla_tejlesites_datum = '$telj_datum', szla_fizetesi_hatarido = '$fiz_hatarido' WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);
//$query = "UPDATE pro_szla_fej SET szla_status = 'ervenytelen' WHERE szla_sorszam='$szla_sorszam'"; 
//$result = mysqli_query($con, $query);

$query = "UPDATE tmp_pro_fej SET szla_sorszam='$szla_sorszam_s', szla_szam='$szla_szam', szla_elotag='$szla_elotag' WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "INSERT INTO szla_fej SELECT * FROM tmp_pro_fej WHERE user_id=$user_id and szla_sorszam='$szla_sorszam_s'"; 
$result = mysqli_query($con, $query);

//számla tétel query
//$query_tetel = "SELECT * FROM szla_tetel where user_id=$user_id and szla_sorszam='$szla_sorszam'"; 
//$result_tetel = mysqli_query($con, $query_tetel);

$query = "CREATE TEMPORARY TABLE tmp_pro_tetel SELECT * FROM pro_szla_tetel WHERE user_id=$user_id and szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_pro_tetel SET table_line_id='null' WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_pro_tetel SET tetel_netto_egysegar = tetel_netto_egysegar, tetel_afaertek = tetel_afaertek, tetel_netto_ertek = tetel_netto_ertek , tetel_brutto_ertek = tetel_brutto_ertek WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "UPDATE tmp_pro_tetel SET szla_sorszam='$szla_sorszam_s', szla_szam='$szla_szam', szla_elotag='$szla_elotag'  WHERE szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);

$query = "INSERT INTO szla_tetel SELECT * FROM tmp_pro_tetel WHERE user_id=$user_id and szla_sorszam='$szla_sorszam_s'"; 
$result = mysqli_query($con, $query);

echo '<br><b>A számla kiállítva:</b>';
//echo '<br><br><a href=szla_pdf3.php?szla_sorszam=' . $szla_sorszam_s . ' class="button_nagy" target="_blank" >Nyomtatás / Megtekintés, Számlaszám: '.$szla_sorszam_s.'</a><br><br><br>';
echo '<br><br><a href=szla_pdf3.php?szla_sorszam=' . $szla_sorszam_s . ' class="button_nagy" target="popup" onclick=window.open("szla_pdf3.php?szla_sorszam=' .  $szla_sorszam_s . '","name","width=800,height=800")  >Nyomtatás / Megtekintés, Számlaszám: '.$szla_sorszam_s.'</a><br><br><br>';
					
?>

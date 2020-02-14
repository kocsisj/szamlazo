<?php 
require('auth.php');
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
//print($_SESSION['username']);
//print($_SESSION['user_id']);
//print($_SESSION['user_status']);
?><!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>kszamla.hu - online számlázó</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/cupertino/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="js/jquery.ui.datepicker-hu.js"></script>
   		<link rel="stylesheet" href="css/menu.css"> 
   		<script src="js/script.js"></script>
		<script src="lib/alertify.min.js"></script>
		<!-- include the core styles -->
		<link rel="stylesheet" href="themes/alertify.core.css" />
		<!-- include a theme, can be included into the core instead of 2 separate files -->
		<link rel="stylesheet" href="themes/alertify.default.css" />
		<link rel="stylesheet" href="css/kszamla.css?v=<?=time();?>" />
		<!-- bootstrap not used -->
		<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script> -->

    </head>

	<script>	
		
alertify.set({ delay: 10000 });

//hogy a menü felülre kerüljön, a statisztika diagramm eltakarta
	 $(document).ready(function() {
		 $('#cssmenu').parent().css('position', 'relative');
		 $('#cssmenu').parent().css('z-index', 1);
	});
		
function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return notie; //It is not IE
}

//if (GetIEVersion() > 0) 
//   alert("This is IE " + GetIEVersion());
//else 
//   alert("This is not IE.");

if (GetIEVersion() < 9 ) 
	{
	alert("Ezzel a böngészővel nem kompatibilis a számlázóprogram, kérem frissítse.\n\nPl. Chorme, Firefox vagy IE 9+"); 
 	 window.history.back();
	}

</script>
	<!-- Menu  -->
		 <body>
		<div id="menu_szelesseg">
			 <?
//Rendszerüzenetek itt
include('szla_havi_total.php');
			 if ($_SESSION['user_first_invoice']=="1")
								{
								print("<b><font color=red>Rendszer üzenet: Mielőtt elkezdenél számlázni kérlek állítsd be az vállalkozásod adatait</font></b>");
								}
			if ($limit==1 and $_SESSION['user_status']=="1")
				{
				print("<b><font color=red>Rendszer üzenet: elérted az ingyenes változat havi nettó 300.000 Ft számlalimitjét.</font></b>");
				}
			?>

		<div id='cssmenu'>
			<ul>
				<!--
				<li>
				    <li class='has-sub'><span><img src='pic/B13175_kszamla_01_k.png' height=50px align='middle'</img></span>
			   </li>
				-->
				<li class='has-sub'><a href='#'><span>Számlázás</span></a>
					<ul>
					 <li><a href='?menu=ujszamla'><span>Új számla</span></a></li>
						<li><a href='?menu=szla_keres'><span>Számla keresés</span></a>
					 <li class='last'><a href='?menu=dijbekero_szamlaz'><span>Számla kiállítás díjbekérő alapján</span></a>
					</ul>
			   </li>
		        <li class='has-sub'><a href='#'><span>Díjbekérő</span></a>
					<ul>
					 <li><a href='?menu=ujdijbekero'><span>Új díjbekérő</span></a></li>
					 <li class='last'><a href='?menu=dijbekero_keres'><span>Díjbekérő keresés</span></a></li>
					</ul>

				 <!--
				<li class='has-sub'><a href='#'><span>Árajánlat</span></a>
					<ul>
					 <li><a href='#'><span>Új árajánlat</span></a></li>
					 <li class='last'><a href='#'><span>Árajánlat keresés</span></a></li>
					</ul>
			   </li>
				-->

			   <li class='has-sub'><a href='#'><span>Törzsadatok</span></a>
				  <ul>
					 <li><a href='?menu=termek'><span>Termék törzs</span></a></li>
					 <li><a href='?menu=vevo'><span>Vevő törzs</span></a>
				  </ul>
			   </li>
			   <li class='has-sub'><a href='#'><span>Lekérdezések</span></a>
				  <ul>
					 <li><a href='?menu=vevostat'><span>Vevő statisztika</span></a></li>
					 <li><a href='?menu=termekstat'><span>Termék statisztika</span></a></li>
					  <li class='last'><a href='?menu=xml_nav'><span>Adóhatósági ellenőrzési adatszolgáltatás</span></a></li>
				  </ul>
			   </li>
			   <li class='has-sub'><a href='#'><span>Beállítások</span></a>
				  <ul>
					 <li><a href='?menu=felhasznalo'><span>Saját Adatok</span></a></li>
					   <!--
					 <li><a href='#'><span>Felhasználók</span></a></li>
					 -->
					 <li><a href='?menu=afakulcs'><span>Áfakulcsok</span></a></li>
					 <li><a href='?menu=szla'><span>Számla beállítások</span></a></li>
					  	 <li><a href='?menu=pro_szla'><span>Díjbekérő beállítások</span></a></li>
					   <li><a href='?menu=logo'><span>Logó feltöltése</span></a></li>
					   <!--
					 <li><a href='#'><span>API felhazsnálók</span></a></li>
					 -->
					 <li class='last'><a href='?menu=pass'><span>Jelszó módosítás</span></a></li>
					   <li class='last'><a href='?menu=xml_nav_bejelento'><span>Számlázó bejelentése</span></a></li>
					  <li class='last'><a href='?menu=elofizetes'><span><font color=red>Előfizetésem</font></span></a></li>
				  </ul>
			   </li>
			   <li class='right'><a href='logout.php'><span>Kilépés </span> <img src='/szamla/pic/exit-icon.png' height=22px  align='top'></img></a></li>
			</ul>
			</div>
		</div>
	<!-- Menu  -->
			<div class="multi-field-wrapper" id="oldal_szelesseg">
				<?
		//ha a cim nem üres akkor legeneráluk a számlát	
				if(!empty($_POST['cim']))
				{
					//echo '<pre>'; 
					//echo "<br />\nCim\n<br />";
					//print_r($_POST['cim']);
					//print_r($_POST['bizonylat_tipus']);
					//echo '</pre>';
					if($_POST['bizonylat_tipus']=="ujszamla")
						{
						include("szla_uj.php");
						echo '<br><b>A számla elkészült:</b>';
						echo '<table>';
						echo '<tr><td>Vevő neve: </td><td>'. $vevo_nev. '</td></tr>';
						echo '<tr><td>Fizetendő bruttó végösszeg: </td><td> '. $szla_total_brutto. ' '.$szla_devizanem.'</tr></td>';
						echo '</table>';
						//echo '<br><a href=szla_pdf3.php?szla_sorszam=' . $szla_sorszam . ' class="button_nagy" target="_blank" >Nyomtatás / Megtekintés, Számlaszám: '.$szla_sorszam.'</a>';
						echo '<br><a href=szla_pdf3.php?szla_sorszam=' . $szla_sorszam . ' class="button_nagy" target="_blank" target="popup" onclick=window.open("szla_pdf3.php?szla_sorszam=' .  $szla_sorszam . '","name","width=800,height=800")  >Nyomtatás / Megtekintés, Számlaszám: '.$szla_sorszam.'</a>';
						if($vevo_email!="")
							{
							echo '&nbsp;<a href=szla_pdf3.php?szla_email=1&szla_sorszam=' . $szla_sorszam . ' class="button_nagy" target="_blank" >Számla küldése emailben: '.$vevo_email.'</a>';
							}
						echo '<br><br><br>';
						}


					if($_POST['bizonylat_tipus']=="ujdijbekero")
						{
						include("dijbekero_uj.php");
						echo '<br><b>A Díjbekérő elkészült:</b>';
						echo '<table>';
						echo '<tr><td>Vevő neve: </td><td>'. $vevo_nev. '</td></tr>';
						echo '<tr><td>Fizetendő bruttó végösszeg: </td><td> '. $szla_total_brutto. ' '.$szla_devizanem.'</tr></td>';
						echo '</table>';
						//echo '<br><a href=pro_szla_pdf3.php?szla_sorszam=' . $szla_sorszam . ' class="button_nagy" target="_blank" >Nyomtatás / Megtekintés, Dijbekérő száma: '.$szla_sorszam.'</a>';
						echo '<br><a href=pro_szla_pdf3.php?szla_sorszam=' . $szla_sorszam . ' class="button_nagy" target="_blank" target="popup" onclick=window.open("pro_szla_pdf3.php?szla_sorszam=' .  $szla_sorszam . '","name","width=800,height=800") >Nyomtatás / Megtekintés, Dijbekérő száma: '.$szla_sorszam.'</a>';
						if($vevo_email!="")
							{
							echo '&nbsp;<a href=pro_szla_pdf3.php?szla_email=1&szla_sorszam=' . $szla_sorszam . ' class="button_nagy" target="_blank" >Díjbekérő küldése emailben: '.$vevo_email.'</a>';
							}
						echo '<br><br><br>';
						$dj="x";
						}
				}


				switch ($_GET['menu'])
					{
						case "":
							if ($_SESSION['user_first_invoice']=="1")
								{
								include("felhasznalo_modositas.php");
								break;
								}
							if ($_POST['bizonylat_tipus']=="ujszamla")
								{
								include("szla_keres.php");
								}
							if ($_POST['bizonylat_tipus']=="ujdijbekero")
								{
								include("pro_szla_keres.php");
								}
							if ($_POST['bizonylat_tipus']=="")
								{
								include("szla_keres.php");
								}
						break;
						case "dijbekero_keres":
							include("pro_szla_keres.php");
						break;
						case "dijbekero_szamlaz": 
							include("pro_szla_keres.php");
						break;
						case "ujszamla":
							if ($_SESSION['user_first_invoice']=="1")
								{
								include("felhasznalo_modositas.php");
								break;
								}
							if ($_SESSION['user_first_invoice']=="1")
								{
								break;
								}
							if ($limit==1 and $_SESSION['user_status']=="1")
								{
								print("<br><br><center><font color=red size=6>Sajnálom, elérted az ingyenes változat havi számlalimitjét.<br><br></font>");
								print("<font color=red size=6>Ebben a hónapban már nem állíthatsz ki több számlát.<br><br></font>");
								print("<font color=green size=6>Fizess elő és akkor korlátlanul használhatod programunkat.<br><br></</font>");
								print("<font color=green>Előfizetés csak 10ezer Ft / év (ami havonta kevesebb mint 840 Ft )<br><br><br></</font>");
								echo '&nbsp;<a href=?menu=elofizetes class="button_nagy"><font size=4>Igen, érdekel. Szeretném tudni a részleteket.</a><br><br><br>';
						
								break;
								}
							include("ujszamla.php");
						break;
						case "ujdijbekero":
							include("ujszamla.php");
						break;
						case "vevo":
							include("vevok_lista.php");
						break;
						case "termek":
							include("termek_lista.php");
						break;
						case "tm":
							include("termek_modositas.php");
						break;
						case "ut":
							include("termek_uj.php");
						break;
						case "vm":
							include("vevo_modositas.php");
						break;
						case "uv":
							include("vevo_uj.php");
						break;
						case "vt":
							include("vevo_torles.php");
							$_GET['menu'] = 'vevo';
							include("vevok_lista.php");
						break;
						case "tt":
							include("termek_torles.php");
							$_GET['menu'] = 'termek';
							include("termek_lista.php");
						break;
						case "felhasznalo":
							include("felhasznalo_modositas.php");
						break;
						case "szla":
							include("szla_beallitasok.php");
						break;
						case "pro_szla":
							include("pro_szla_beallitasok.php");
						break;
						case "afakulcs":
							include("afakulcs_lista.php");
						break;
						case "szla_lista":
							include("szla_lista.php");
						break;
						case "uafa":
							include("afakulcs_uj.php");
						break;
						case "mafa":
							include("afakulcs_modositas.php");
						break;
						case "tafa":
							include("afakulcs_torles.php");
							include("afakulcs_lista.php");
						break;
						case "pass":
							include("jelszo_modositas.php");
						break;
						case "logo":
							include("logo.php");
						break;
						case "szla_keres":
							include("szla_keres.php");
						break;
						case "xml_nav":
							include("xml_nav.php");
						break;
						case "vevostat":
							include("vevo_stat.php");
						break;
						case "termekstat":
							include("termek_stat.php");
						break;
						case "storno":
							include("szla_storno.php");
							include("szla_keres.php");
						break;
						case "pro_szla_szamla":
							include("pro_szla_szamla.php");
							include("szla_keres.php");
						break;
						case "xml_nav_bejelento":
							include("xml_nav_bejelento.php");
						break;
						case "elofizetes":
							 //if ($_SESSION['user_status']=="1")
							//	{
							//	include("felhasznalo_modositas.php");
							//	break;
							//	}
							include("elofizetes.php");
						break;
					}
			?>
		</div>
	</body>
	<div id="lablec_szelesseg">
			<small>
			<a href=https://kszamla.hu/felhasznaloi_utmutato/kszamla_felhasznaloi_utmutato.pdf target=_blank>Felhasználói kézikönyv</a>
			&nbsp;&nbsp;&nbsp;
			<a href=https://kszamla.hu/aszf target=_blank>ÁSZF</a>
			&nbsp;&nbsp;&nbsp;
			<a href=https://kszamla.hu/adatvedelem target=_blank>Adatvédelmi nyilatkozat</a>
			&nbsp;&nbsp;&nbsp;
			<a href=https://kszamla.hu/kapcsolat target=_blank>Kapcsolat</a>
			<br>
			<img src='pic/B13175_kszamla_01_k.png' height=30px</img>
    </div>
</html>

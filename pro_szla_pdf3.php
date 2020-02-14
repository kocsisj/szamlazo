<?php  
require('auth.php');
include('config.php');    //include of db config file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$afa = array();
$afa_ertek[] = array();

$username = ($_SESSION['username']);
$user_id=$_SESSION["user_id"];

//$szla_sorszam = "2016/000006";

$szla_sorszam = $_GET['szla_sorszam'];
$szla_email = $_GET['szla_email'];
//szÃ¡mla fejlÃ©c query
$query = "SET NAMES cp1250"; 
$result = mysqli_query($con, $query);
$query = "SELECT * FROM pro_szla_fej where user_id=$user_id and szla_sorszam='$szla_sorszam'"; 
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

//szÃ¡mla tÃ©tel query
$query_tetel = "SELECT * FROM pro_szla_tetel where user_id=$user_id and szla_sorszam='$szla_sorszam'"; 
$result_tetel = mysqli_query($con, $query_tetel);

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
			
			// oszerakjuk a cimet
				$felhasznalo_cimsor1 = $felhasznalo_irszam.", ".$felhasznalo_varos;
				if ($felhasznalo_orszag != "") { $felhasznalo_cimsor1 = $felhasznalo_orszag.", ".$felhasznalo_cimsor1;}
				$felhasznalo_cimsor2 = $felhasznalo_utca." ".$felhasznalo_utca_megnevezes." ".$felhasznalo_utca_hazszam;
				//eltavolitjuk a pontot a sor vegerol
				$felhasznalo_epulet = rtrim($felhasznalo_epulet, '.');
				$felhasznalo_lepcsohaz = rtrim($felhasznalo_lepcsohaz, '.');
				$felhasznalo_emelet = rtrim($felhasznalo_emelet, '.');
				$felhasznalo_ajto = rtrim($felhasznalo_ajto, '.');
				//hozzarakjuk a megfelelo neveket
				if ($felhasznalo_epulet != "") { $felhasznalo_epulet = $felhasznalo_epulet.". Epulet"; }
				if ($felhasznalo_lepcsohaz != "") { $felhasznalo_lepcsohaz = $felhasznalo_lepcsohaz.". lph"; }
				if ($felhasznalo_emelet != "") { $felhasznalo_emelet = $felhasznalo_emelet.". Emelet"; }
				if ($felhasznalo_ajto != "") { $felhasznalo_ajto = $felhasznalo_ajto.". Ajto";}
				$felhasznalo_cimsor3 = $felhasznalo_epulet." ".$felhasznalo_lepcsohaz." ".$felhasznalo_emelet." ".$felhasznalo_ajto;
			//$felhasznalo_logo = $row['logo_filename'];

			$vevo_nev =$row['vevo_nev'];
			$vevo_orszag =$row['vevo_orszag'];
			$vevo_varos =$row['vevo_varos'];
			$vevo_irszam =$row['vevo_irszam'];
			$vevo_utca =$row['vevo_utca'];
			$vevo_utca_megnevezes =$row['vevo_utca_megnevezes'];
			$vevo_utca_hazszam =$row['vevo_utca_hazszam'];
			$vevo_epulet =$row['vevo_epulet'];
			$vevo_lepcsohaz =$row['vevo_lepcsohaz'];
			$vevo_emelet =$row['vevo_emelet'];
			$vevo_ajto =$row['vevo_ajto'];
			$vevo_adoszam =$row['vevo_adoszam'];
			$vevo_eu_adoszam =$row['vevo_eu_adoszam'];
			$vevo_csasz =$row['vevo_csasz'];
			$vevo_email =$row['vevo_email'];
			$vevo_bankszamla =$row['vevo_bankszamla'];
			// osszerekjuk a cimet
				$vevo_cimsor1 = $vevo_irszam.", ".$vevo_varos;
				if ($vevo_orszag != "") { $vevo_cimsor1 = $vevo_orszag.", ".$vevo_cimsor1;}
				$vevo_cimsor2 = $vevo_utca." ".$vevo_utca_megnevezes." ".$vevo_utca_hazszam;
				//eltavolitjuk a pontot a sor vegerol
				$vevo_epulet = rtrim($vevo_epulet, '.');
				$vevo_lepcsohaz = rtrim($vevo_lepcsohaz, '.');
				$vevo_emelet = rtrim($vevo_emelet, '.');
				$vevo_ajto = rtrim($vevo_ajto, '.');
				//hozzarakjuk a megfelelo neveket
				if ($vevo_epulet != "") { $vevo_epulet = $vevo_epulet.". Epulet"; }
				if ($vevo_lepcsohaz != "") { $vevo_lepcsohaz = $vevo_lepcsohaz.". lph"; }
				if ($vevo_emelet != "") { $vevo_emelet = $vevo_emelet.". Emelet"; }
				if ($vevo_ajto != "") { $vevo_ajto = $vevo_ajto.". Ajto";}
				$vevo_cimsor3 = $vevo_epulet." ".$vevo_lepcsohaz." ".$vevo_emelet." ".$vevo_ajto;

			$szla_datum = $row['szla_datum'];
			$szla_tejlesites_datum = $row['szla_tejlesites_datum'];
			$szla_fizetesi_hatarido = $row['szla_fizetesi_hatarido'];
			$szla_fizetesi_mod = $row['szla_fizetesi_mod'];	
			$szla_megjegyzes =$row['szla_megjegyzes'];
			$szla_total_netto = $row['szla_total_netto'];
			$szla_total_afa = $row['szla_total_afa'];
			$szla_total_brutto = $row['szla_total_brutto'];
			$szla_elotag = $row['szla_elotag'];
			$szla_szam = $row['szla_szam'];
			$szla_sorszam = $row['szla_sorszam'];
			$szla_devizanem = $row['szla_devizanem'];
			$szla_status = $row['szla_status'];
			$szla_logo = $row['szla_logo'];

require('1/fpdf.php');

    function SetDash($black=null, $white=null)
    {
        if($black!==null)
            $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }


class PDF extends FPDF
{

// Page header
function Header()
{
	$szla_s = $_GET['szla_sorszam'];
	$szla_logo = $_GET['szla_logo'];
	$user_id=$_SESSION["user_id"];
	//kell a globals hogy a valtozo erteke atjojjon
	$szla_status_s = $GLOBALS['szla_status'];
	$szla_logo_s = $GLOBALS['szla_logo'];
	$felhasznalo_logo = 'logo/'.$szla_logo_s;
    // Logo
	if ($szla_logo_s != "" and file_exists($felhasznalo_logo)) { $this->Image($felhasznalo_logo,10,10,0,8);}
	$this->Line(10,20,200,20);
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Titles
    //$this->Cell(30,10,utf8_decode('Számla'),0,0,'C');
	if ($szla_status_s == "ervenytelenito_szamla") {
		 $this->SetFont('Arial','B',12);
		$this->Cell(30,10,'Érvénytelenítõ Számla',0,0,'C');
		}
		else
		{
		$this->AddFont('arial','','arial.php');
		$this->AddFont('arialbd','','arialbd.php');
		$this->SetFont('arial','',15);
		$this->SetFont('arialbd','',15);
		$this->Cell(30,10,'Díjbekérõ (proforma számla)',0,0,'C');
		}
	
	$this->SetFont('Arial','B',10);
	$this->Cell(80,10,'Sorszám: '.$szla_s,0,0,'R');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
	
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
	//$this->Line(10,280,200,280);
	$this->Cell(0,10,'A számla a  www.kszamla.hu számlázóprogrammal készült',0,0,'C');
    $this->Cell(0,10,'Oldal '.$this->PageNo().'/{nb}',0,0,'R');
	 $this->Ln(20);
 
}

function SetDash($black=null, $white=null)
    {
        if($black!==null)
            $s=sprintf('[%.3F %.3F] 0 d',$black*$this->k,$white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
		}
}
 
// Instanciation of inherited class
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->Cell(180,0,$szla_sorszam,0,0,'R');
$pdf->AddFont('arial','','arial.php');
$pdf->AddFont('arialbd','','arialbd.php');
$pdf->SetFont('arial','',10);
$pdf->SetFont('arialbd','',10);
//itt irjuk a szamlara a eledo adatokat
//$pdf->text(10,30,utf8_decode('Kiállító: '));
$pdf->text(10,30,'Kiállító:');
$pdf->SetFont('Arial','',9);
$pdf->text(15,35,$felhasznalo_nev);
$pdf->text(15,40,$felhasznalo_cimsor1);
$pdf->text(15,45,$felhasznalo_cimsor2);
$v=50;
if ($felhasznalo_cimsor3 != "   ") { $pdf->text(15,$v,$felhasznalo_cimsor3); $v= $v + 5;}  //harom szokoz kell, mert az Ã¶sszefÃ¼zes soran 3 szokoz kerÃ¼l bele ha Ã¼res
if ($felhasznalo_adoszam != "") {$pdf->text(15,$v,"Adószám: ".$felhasznalo_adoszam); $v= $v + 5;}
if ($felhasznalo_eu_adoszam != "") { $pdf->text(15,$v,"EU Adószám: ".$felhasznalo_eu_adoszam); $v= $v + 5;}
if ($felhasznalo_csasz != "") { $pdf->text(15,$v,"CSASZ: ".$felhasznalo_csasz); $v= $v + 5;}
if ($felhasznalo_bankszamla != "") { $pdf->text(15,$v,"Bankszámlaszám:".$felhasznalo_bankszamla); $v= $v + 5;}





//itt irjuk a szamlara a vevo adatokat
$pdf->SetFont('arialbd','',10);
//$pdf->text(110,30,utf8_decode('Vevõ: '));
$pdf->text(110,30,'Vevõ: ');
$pdf->SetFont('arial','',9);
$pdf->text(115,35,$vevo_nev);
$pdf->text(115,40,$vevo_cimsor1);
$pdf->text(115,45,$vevo_cimsor2);
$v=50;
if ($vevo_cimsor3 != "   ") { $pdf->text(115,$v,$vevo_cimsor3); $v= $v + 5;}   //harom szokoz kell, mert az Ã¶sszefÃ¼zes soran 3 szokoz kerÃ¼l bele ha Ã¼res
if ($vevo_adoszam != "") {$pdf->text(115,$v,"Adószám: ".$vevo_adoszam); $v= $v + 5;}
if ($vevo_eu_adoszam != "") { $pdf->text(115,$v,"EU Adószám: ".$vevo_eu_adoszam); $v= $v + 5;}
if ($vevo_csasz != "") { $pdf->text(115,$v,"CSASZ: ".$vevo_csasz); $v= $v + 5;}
if ($vevo_bankszamla != "") { $pdf->text(115,$v,"Bankszámlaszám:".$vevo_bankszamla); $v= $v + 5;}

//$pdf->text(115,50,$vevo_cimsor3);
//$pdf->text(115,55,"Adószám: ".$vevo_adoszam);
//$pdf->text(115,60,"EU Adószám: ".$vevo_eu_adoszam);
//$pdf->text(115,65,"CSASZ: ".$vevo_csasz);
//$pdf->text(115,70,"Bankszámlaszám: ".$vevo_bankszamla);

$pdf->Line(10,72,200,72);
//a fizetes adatai és szamlaszam
$pdf->text(10,76,'Fizetés módja: ');
$pdf->text(25,80,$szla_fizetesi_mod);

$pdf->text(60,76,'Kiállítás dátuma: ');
$pdf->text(65,80,$szla_datum);

//$pdf->text(110,76,'Teljesítés dátuma: ');
//$pdf->text(115,80,$szla_tejlesites_datum);

$pdf->text(170,76,'Fizetési határidõ: ');
$pdf->text(175,80,$szla_fizetesi_hatarido);

//$pdf->text(170,76,utf8_decode('Szamlaszam: '));
//$pdf->text(175,80,$szla_sorszam);

$pdf->Line(10,81,200,81);

// Tetelek kiirasa - fejlec
$pdf->SetXY( 10,85 );
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(10); 
	$pdf->Cell(10,0,'Mennyiség',0,1,'R');
	$pdf->Cell(50); 
	$pdf->Cell(10,0,'Nettó egységár',0,1,'R');
	$pdf->Cell(70); 
	$pdf->Cell(10,0,'Áfakulcs',0,1,'R');
	$pdf->Cell(110); 
	$pdf->Cell(10,0,'Nettó ár',0,1,'R');
	$pdf->Cell(145); 
	$pdf->Cell(10,0,'Áfa',0,1,'R');
	$pdf->Cell(180); 
	$pdf->Cell(10,0,'Bruttó ár',0,1,'R');
	$pdf->Ln(5);

// Tetelek kiirasa - adatok
while ($row = $result_tetel->fetch_assoc()) {

	$pdf->Cell(1); 
		//$pdf->SetLineWidth(0.2);
		//$pdf->SetDash(5,5);
		$pdf->SetDrawColor(170, 170, 170);
		//$pdf->SetFont('Arial','I',9);
		$pdf->SetFont('arial','',9);
		$pdf->Cell(190,5,$row['tetel_megnevezes'],T,1,'L'); 
		$pdf->Ln(3);
	$pdf->Cell(1); 
		$pdf->SetFont('arial','',9);
		$pdf->Cell(20,0,$row['tetel_mennyiseg'].' '.$row['tetel_mennyisegi_egyseg'],0,1,'R');  
	//$pdf->Cell(40); 
	//	$pdf->Cell(10,0,$row['tetel_mennyisegi_egyseg'],0,1,'R'); 
	$pdf->Cell(50); 
		$t_n_e = number_format($row['tetel_netto_egysegar'], 0, ',', ' ');
		$pdf->Cell(10,0,$t_n_e." Ft",0,1,'R');  
	$pdf->Cell(70); 
		$pdf->Cell(10,0,$row['tetel_afa_nev'],0,1,'R');  
	$pdf->Cell(110);
		$t_n_e = number_format($row['tetel_netto_ertek'], 0, ',', ' ');
		$pdf->Cell(10,0,$t_n_e." Ft",0,1,'R');
	$pdf->Cell(145);
		$t_a = number_format($row['tetel_afaertek'], 0, ',', ' ');
		$pdf->Cell(10,0,$t_a." Ft",0,1,'R');  
	$pdf->Cell(180); 
		$t_b_e = number_format($row['tetel_brutto_ertek'], 0, ',', ' ');
		$pdf->Cell(10,0,$t_b_e." Ft",0,1,'R');  

	$pdf->Ln(3);
	// tetel kiiras közben megcsinaljuk az afa osszesitot
	if (!in_array($row['tetel_afa_nev'], $afa))
	{
		$afa[] = $row['tetel_afa_nev'];

	}

	$afa_netto_ertek[$row['tetel_afa_nev']] = $afa_netto_ertek[$row['tetel_afa_nev']] + $row['tetel_netto_ertek'];
	$afa_ertek[$row['tetel_afa_nev']] = $afa_ertek[$row['tetel_afa_nev']] + $row['tetel_afaertek'];
	$afa_brutto_ertek[$row['tetel_afa_nev']] = $afa_brutto_ertek[$row['tetel_afa_nev']] + $row['tetel_brutto_ertek'];


	//array_push($data, $name);	
}

// afa osszesoto fejlecenek ekeszitese
	$pdf->SetFont('arial','',9);
	$pdf->Ln(10);
	$pdf->Cell(80);
	$pdf->Cell(20,4,'Áfakulcs',B,0,'R');
	//$pdf->Cell(120); 
	$pdf->Cell(30,4,'Nettó',B,0,'R');
	//$pdf->Cell(150); 
	$pdf->Cell(30,4,'Áfa',B,0,'R');
	//$pdf->Cell(80); 
	//$pdf->Cell(110,3,'brutto',B,1,'R');
	$pdf->Cell(30,4,'Bruttó',B,1,'R');
	$pdf->Ln(4);

	
	
// afa osszesito adattatrtalmanak kiirasa
for ($x = 0; $afa[$x] != "" ; $x++) {

	$pdf->Cell(90); 
		$pdf->Cell(10,0,$afa[$x],0,1,'R');
	$pdf->Cell(120); 
		$a_n_e = number_format($afa_netto_ertek[$afa[$x]], 0, ',', ' ');
		$pdf->Cell(10,0,$a_n_e." Ft",0,1,'R'); 
	$pdf->Cell(150); 
		$a_e = number_format($afa_ertek[$afa[$x]], 0, ',', ' ');
		$pdf->Cell(10,0,$a_e." Ft",0,1,'R');
	$pdf->Cell(180); 
		$a_b_e = number_format($afa_brutto_ertek[$afa[$x]], 0, ',', ' ');
		$pdf->Cell(10,0,$a_b_e." Ft", 0, 1,'R');
	$pdf->Ln(6);

} 




$pdf->Cell(90);
	$pdf->Cell(10,0 ,'Összesen', 0, 1,'R');
$pdf->Cell(120);	
	$sz_t_n = number_format($szla_total_netto, 0, ',', ' ');
	$pdf->Cell(10, 0,$sz_t_n.' Ft', 0, 1,'R');
$pdf->Cell(150);
	$sz_t_a = number_format($szla_total_afa, 0, ',', ' ');
	$pdf->Cell(10, 0,$sz_t_a.' Ft', 0, 1,'R');
$pdf->Cell(180);
	$sz_t_b = number_format($szla_total_brutto, 0, ',', ' ');
	$pdf->Cell(10, 0,$sz_t_b.' Ft', 0, 1,'R');
$pdf->Ln(3);
$pdf->Cell(80);
	$pdf->SetFont('arialbd','',12); 
	$pdf->Cell(110,10,'Fizetendõ bruttó végösszeg: '.$sz_t_b.' Ft', T, 1,'R');

$pdf->Ln(5);
$pdf->SetFont('arial','',9); 	
$pdf->Cell(30,5,'Megjegyzés: ', 0, 1,'L');
$pdf->Cell(5); 
$pdf->MultiCell( 180, 5, $szla_megjegyzes, 0);

if ($szla_email == 1) {
$pdf->Output(F, 'email_szamla/'.$szla_elotag.'-'.$szla_szam.'-'.$username.'.pdf', true);
$filename=$szla_elotag.'-'.$szla_szam.'-'.$username.'.pdf';
include('pro_szla_email.php');
} 
else
	{
$pdf->Output(I, md5($szla_sorszam), true);
} 
?>

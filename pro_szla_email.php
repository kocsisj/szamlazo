<script>
alertify.alert("A levelet sikeresen kiküldtük:");
</script>
<META HTTP-EQUIV="refresh" CONTENT="2; URL=/szamla/szamla.php?menu=dijbekero_keres">
<?php  
error_reporting(E_ALL);
ini_set("display_errors", 1);

//require("phpmailer/class.phpmailer.php");  
require("phpmailer/PHPMailerAutoload.php"); 

$target_dir = "/szamla/email_szamla/";

$home_folder=$_SERVER['DOCUMENT_ROOT'];

$directory=$home_folder.$target_dir;

$attachement=$filename;

//email szétszedése
$email_parts = explode('@', $vevo_email);
$email_user = $email_parts[0];
$email_domain = $email_parts[1];

$mail = new PHPMailer();  
  
$mail->IsSMTP();                                   // SMTP-n keresztüli küldés  

// ha gmailra kell küldeni akkor a gmail smtp szerverét használjuk, mert a különben könnyen megyünk a spam-be
if ($email_domain=="gmail.com") {
// ha igaz;
	$mail->Host     = "smtp-relay.gmail.com"; // SMTP szerverek  
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
} else {
// 	ha hamis;
	$mail->Host     = "kszamla.hu"; // SMTP szerverek  
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;

	$mail->SMTPAuth = true;                            // SMTP autentikáció bekapcs  
	$mail->Username = "szamla@kszamla.hu";                         // SMTP felhasználó  
	$mail->Password = "Hptig6S#HjWL";            // SMTP jelszó 
}

$mail->SetLanguage("hu", "php_mailer/language");    //karakterkódolás hogy legyen ekezetes bető
$mail->CharSet   = "utf-8";							 //karakterkódolás hogy legyen ekezetes bető

$mail->From     = "szamla@kszamla.hu";                // Feladó e-mail címe  
//$mail->FromName = "kszamla";     // Feladó neve  
$mail->FromName = utf8_encode($felhasznalo_nev);
//$mail->AddAddress("jozsef.kocsis@pontcom.com","Kocsis Jozsef");   // Címzett és neve  
$mail->AddAddress($vevo_email,$vevo_nev);   // Címzett és neve  
//$mail->AddAddress("ellen@site.com");               // Még egy címzett 
// $mail->AddBCC("jozsef.kocsis@pontcom.com","Kocsis Jozsef"); 
$mail->AddReplyTo("szamla@kszamla.hu","no-reply");  // Válaszlevél ide  

$mail->WordWrap = 50;                              // Sortörés állítása  
//$mail->AddAttachment($directory."/KJ-2016-000133-ppp.pdf"); 
$mail->AddAttachment($directory."/".$attachement); 
//$mail->AddAttachment("/var/tmp/file.tar.gz");      // Csatolás  
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // Csatolás más néven  
$mail->IsHTML(true);                               // Küldés HTML-ként  
  
$mail->Subject = ("Értesítés ". $szla_sorszam. " sorszámú díjbekérö kiállításról");            // A levél tárgya  
$mail->Body    =  ("<b>Tisztelt Hölgyem/Uram!</b><br><br>Mellékelten küldjük díjbekérőnket. <br>Díjbekérő sorszáma: ". $szla_sorszam. " <br><br> A díjbekérő teljesítése után számlát állítunk ki.<br><br>
<br><br>Üdvözlettel:<br>".utf8_encode($felhasznalo_nev));   // A levél tartalma  
//$mail->AltBody = "This is the text-only body";     // A levél szöveges tartalma  
  
if (!$mail->Send()) {  
  echo utf8_decode("A levél nem került elküldésre<br>");  
  echo utf8_decode("A felmerült hiba: ") . $mail->ErrorInfo;  
  exit;  
}  
  
echo utf8_decode("<center><br><br><br><b>A levelet sikeresen kiküldtük.<br><br><img width=100px src='pic/spinner.gif'><center>");  

//include('szamla.php');

?>

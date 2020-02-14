<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require('config.php');

// sql irasi teszt
//$trn_date = date("Y-m-d H:i:s");
//$query = "INSERT into `paypal_ipn` (username, txn_id, item_name, payment_status, trn_date, mc_gross, payer_email) VALUES ('1', '2', '3', '4', '$trn_date', '5', '6')";
//mysqli_query($con,  $query );


// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}
// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
 
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

$custom = $_POST['custom'];
$item_name = $_POST['item_name'];
$payment_status = $_POST['payment_status'];
$txn_id = $_POST['txn_id'];
$payer_email = $_POST['payer_email'];
$mc_gross = $_POST['mc_gross'];

$trn_date = date("Y-m-d H:i:s");

if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {

// Sikeres és ellenőrzött fizetés esetén!

//paypal ipn táble kitöltése a fizetés adataibel
$query = "INSERT into `paypal_ipn` (username, txn_id, item_name, payment_status, trn_date, mc_gross, payer_email) VALUES ('$custom', '$txn_id', '$item_name', '$payment_status', '$trn_date', '$mc_gross', '$payer_email')";
mysqli_query($con, $query) or die(mysql_error());

// felhasználók tábla frissítése 2-es státuszra, hogy az előfizetés aktiválva van
$oneYearOn = date('Y-m-d', strtotime('+1 year'));
$felhasznalo_status_code="2";
$update="update felhasznalok set felhasznalo_status_code='".$felhasznalo_status_code."', felhasznalo_status_code_date='".$oneYearOn."', fizetes_tx='".$txn_id."' where username='".$custom."'";
mysqli_query($con, $update) or die(mysql_error());

}

else if (strcmp ($res, "INVALID") == 0) {
 
// Sikertelen fizetés esetén, meg kell nézni mi történt!
$query = "INSERT into `paypal_ipn` (username, txn_id, item_name, payment_status, trn_date, mc_gross, payer_email) VALUES ('$custom', '$txn_id', '$item_name', '$payment_status', '$trn_date', '$mc_gross', '$payer_email')";
mysqli_query($con, $query); 

}
}
fclose ($fp);
}



?>
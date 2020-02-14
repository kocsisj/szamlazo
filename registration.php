<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/cupertino/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/hu.messages.validate.js"> </script>
<meta charset="utf-8">
<title>Kszamla - számlázó program - regisztáció</title>

        <style>
		.error {
				color: red;
			}

		input[type=text], select  {
            padding: 10px 4px;    /* doboz mérete */
            margin: 2px 0;			/* sorok közti távolság */
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

		input[type=email], select  {
            padding: 10px 4px;    /* doboz mérete */
            margin: 2px 0;			/* sorok közti távolság */
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

		input:focus, select:focus { 
			outline:none;
			border-color:lightblue;			/* az aktiv input box keretének szine */
			box-shadow:0 0 10px lightblue;		/* az aktiv input box keretének szine */
		}


        input[type=number], select {
            padding: 10px 4px;    
            margin: 2px 5px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
			width: 100px;
        }

        input[type=password], select {
            padding: 10px 4px;    
            margin: 2px 0px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

      input[type=submit] {
            background-color: #389fbd;
            color: white;
            padding: 6px 20px;
            margin: 2px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
			font:normal 15px/22px Arial, Sans-Serif;
        }
		 input[type=submit]:hover {
            background-color: #0073cc; 0073cc  //gomb színe ha az egér rajta van 
			}

			input[type="checkbox"] {
			width: 25px;
			height: 25px;
			padding: 5em;
			border: 0px solid #369;
			}

        .button {
            background-color: #389fbd;
            color: white;
            padding: 6px 20px;
            margin: 4px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
			font:normal 15px/22px Arial, Sans-Serif;
        }

		.button:hover {
            background-color: #0073cc;    //gomb színe ha az egér rajta van 

			}

		body {
			font-family: Arial, Sans-Serif;
			font-size: 15px/22px; 
			margin-top: 0.5em;
			margin-bottom: 0em;
			line-height: 25px;
			background-color: #efefef;  //fokepernyő háttérszín
			background: #efefef; /* For browsers that do not support gradients */    
			background: -webkit-linear-gradient(left, #efefef , lightgrey); /* For Safari 5.1 to 6.0 */
			background: -o-linear-gradient(right, #efefef, lightgrey); /* For Opera 11.1 to 12.0 */
			background: -moz-linear-gradient(right, #efefef, lightgrey); /* For Firefox 3.6 to 15 */
			background: linear-gradient(to right, #efefef , lightgrey); /* Standard syntax (must be last) */
			}

		div {
            border-radius: 0px;
			margin: auto;
            background-color: #F6F5FA;   //háttérszín
			padding: 0px;   			//sorok köztis távolság
			font-style: Arial, Sans-Serif;
			min-height: 900px;
			}

		#oldal_szelesseg {
				//width: 1024px;
				width: 1100px;
				//width: 1280px;
				padding: 10px;
				 padding-bottom: 1cm;
				min-height: 750px;
			}

		#menu_szelesseg {
				//width: 1024px;
				width: 1120px;
				//width: 1280px;
				padding: 1px;
				border-radius: 0px;
				border: none;
				//background-color: #2b2b2b;
			}

		#lablec_szelesseg {
				//width: 1024px;
				Width: 1120px;
				padding: 1px;
				border-radius: 0px;
				border: none;
				background-color: #2b2b2b;
				text-align: center;
				min-height: 40px;

			}
			 </style>
</head>
<script>
$(document).ready(function () {

    $('#registration').validate({ // initialize the plugin
        rules: {
            username: {
                required: true,
				minlength: 5
            },
            email: {
                required: true,
				    email: true
            },
			password: {
                required: true,
				   minlength: 8
            }
        },
		submitHandler: function (form) {
            form.submit();
        },
    });

});


function checkPass()
{
    //Store the password field objects into variables ...
    var password = document.getElementById('password');
    var password2 = document.getElementById('password2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    //var goodColor = "#66cc66";
	var goodColor = "white";
    //var badColor = "#ff6666";
	var badColor = "red";
    //Compare the values in the password field 
    //and the confirmation field
    if(password.value == password2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        password2.style.backgroundColor = goodColor;
		password2.style.borderColor = "lightgrey";
        message.style.color = goodColor;
        message.innerHTML = ""   // ha a két jelszó megyegyezik
		document.getElementById('submit').disabled = false;
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        //password2.style.backgroundColor = badColor;
		password2.style.borderColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "A két jelszó nem egyezik meg!"
		document.getElementById('submit').disabled = true;
    }


}

</script>


<body>
<?php
require('config.php');
$elofizetes_aktivalasa = $_POST['elofizetes_aktivalasa'];
// Ha a regisztáció kitölve és akkor beleirjuk az adatbazisba (vizsgáljuk, hogy van-e usernév, ez jelenti a kitöltést)
if (isset($_POST['username'])){
        $username = $_POST['username'];
		$email = $_POST['email'];
        $password = $_POST['password'];
		$csomag = $_POST['csomag'];
		$elofizetes_aktivalasa = $_POST['elofizetes_aktivalasa'];
		$username = stripslashes($username);
		$username = mysqli_real_escape_string($con, $username);
		$email = stripslashes($email);
		$email = mysqli_real_escape_string($con, $email);
		$password = stripslashes($password);
		$password = mysqli_real_escape_string($con, $password);
		$trn_date = date("Y-m-d H:i:s");

		// megvizsgáluk, hogy létezik-e már a felhasználónév
		$query = "SELECT username FROM `felhasznalok` WHERE username = '$username'";
		$result_check = mysqli_query($con, $query); 
		$rowcount=mysqli_num_rows($result_check);

			if($rowcount == 0) {
			//echo "nincs még ilyen felhazsnáló akkot regisztálunk";
			$password_salt=md5($password);
			$query = "INSERT into `felhasznalok` (username, password, email, trn_date, felhasznalo_first_invoice, felhasznalo_status_code) VALUES ('$username', '".hash('sha512', $password_salt.$password.$password_salt)."', '$email', '$trn_date', '1',  '1')";
			$result = mysqli_query($con, $query); 
				if($result){
				echo "<div id='menu_szelesseg'>";
				echo "<div id='lablec_szelesseg'>";
				echo "</div>";
					If ($csomag==1){
           			echo "<center><h3>Regisztáció sikeres.</h3><br/><a href='login.php'>Kattints ide a belépéshez</a></div>";
					}
					else
					{
					echo "<center><h3>Regisztáció sikeres.</h3><br/>Válasszon fizetési módot:";
					include("fizetes.php");
					echo "</div>";

					}

			// E-mail küldése a regisztáció után
					require("phpmailer/PHPMailerAutoload.php"); 

					$target_dir = "/szamla/email_szamla/";

					$home_folder=$_SERVER['DOCUMENT_ROOT'];

					$directory=$home_folder.$target_dir;

					$attachement=$filename;
					
					//email szétszedése
					$email_parts = explode('@', $email);
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
						$mail->Host     = "smtphost.hu"; // SMTP szerverek  
						$mail->SMTPSecure = 'ssl';
						$mail->Port = 465;

						$mail->SMTPAuth = true;                            // SMTP autentikáció bekapcs  
						$mail->Username = "username@username.hu";                         // SMTP felhasználó  
						$mail->Password = "password";            // SMTP jelszó 
					}

					$mail->SetLanguage("hu", "php_mailer/language");    //karakterkódolás hogy legyen ekezetes bető
					$mail->CharSet   = "utf-8";							 //karakterkódolás hogy legyen ekezetes bető
					$mail->From     = "szamla@valami.hu";                // Feladó e-mail címe  
					$mail->FromName = ("Kszámla online számlázó");     // Feladó neve  

					$mail->AddAddress($email,$username);   // Címzett és neve  
					//$mail->AddBCC("szamla@valami.hu","valaki");
					$mail->AddReplyTo("szamla@valami.hu","no-reply");  // Válaszlevél ide  

					$mail->WordWrap = 50;                              // Sortörés állítása  

					$mail->IsHTML(true);                               // Küldés HTML-ként  

					$mail->Subject = ("Kszámla Online Számlázó rendszer regisztráció");            // A levél tárgya  
					$mail->Body    =   ("<b>Tisztelt ". $username."!</b><br><br>A regisztáció sikeresen megtörtént. <br><br><table border='0'><tr><td>Felhasználónév: &nbsp; &nbsp;&nbsp; </td><td>". $username. "</td></tr><tr><td>Jelszó: </td><td>". $password. " </td></tr></table><br>Belépés: <a href='login.php'>Kszamla online számlázó</a><br><br>Felhasználói útmutató: <a href='felhasznaloi_utmutato/kszamla_felhasznaloi_utmutato.pdf'>LETÖLTÉS</a><br><br>Teendők az elsö számla kiállítása előtt (BEÁLÍTÁS MENÜ):<br> <ul><li>Állítsa be a szükséges adatokat (Név, Cim, Adószám, Stb...). </li><li>Végezze el a számla/díjbekérő beállitásait <br> </li></ul>
<br>Szép Napot! <br> Kszámla Online Számlázó rendszer <br>");   // A levél tartalma  
					//$mail->AltBody = "This is the text-only body";     // A levél szöveges tartalma  

					if (!$mail->Send()) {  
						echo utf8_decode("Hiba a regsztációs levél kiküldésekor<br>");  
						echo utf8_decode("A felmerült hiba: ") . $mail->ErrorInfo;  
						exit;  
					}  



					}
			//ha léztezik a felhasználónév akkor nem regisztálunk, vissza a reg-hez
			} else {
				echo "<div id='menu_szelesseg'>";
				echo "<div id='lablec_szelesseg'>";
				echo "</div>";
				echo "<center><h3>Ez a felhasználónév már foglalt.</h3><br/>Vissza a regisztrációhoz <a href='registration.php'>Regisztáció</a></div>";
			}

}
elseif ($elofizetes_aktivalasa == 1) 
{
	echo "<div id='menu_szelesseg'>";
	echo "<div id='lablec_szelesseg'>";
	echo "</div>";
	$trn_date = date("Y-m-d H:i:s");
	$oneYearOn = date('Y-m-d', strtotime('+1 year'));
	$felhasznalo_status_code="2";

	if ($_POST['fizetesi_mod']=="bank")
	{
		$username_reg=$_POST["username_reg"];
		$update="update felhasznalok set felhasznalo_status_code='".$felhasznalo_status_code."', felhasznalo_status_code_date='".$oneYearOn."' where username='".$username_reg."'";
		mysqli_query($con, $update) or die(mysql_error());
		$status = "<br><br><center>Az előfizetés aktiválása megtörtént.</br></br>Díjbekérőnket az regsztrációkor megadott e-mail címre fogjuk elküldeni, a díjbekérőn kiegyenlítése után számlát állítunk ki. <br><br>Ammennyiben bármilyen kérdése lenne, kérem vegye fel velünk a kapcsolatot elérhetőségeink egyikén.<br><br><a href='http://xxxxxx.hu/szamla/szamla.php' class='button' >Tovább a számlázóba</a></center>";


	}

	if ($_POST['fizetesi_mod']=="paypal")
	{
		$username=$_POST["username_reg"];
		include("fizetes_paypal.php");
	}
	echo '<p style="color:#FF0000;">'.$status.'</p></div>';

}
else
{
?>

<div id="menu_szelesseg">
<div id="lablec_szelesseg">
</div>
<br><br>
<center>
<img src="pic/kszamla_belepes_logo.gif" width=300px alt="számlázó program 2017"></img>
<h3>Regisztráció</h3>
</center>
<form name="registration" action="" method="post" id="registration">
<table>
<td></td>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>Felhasználónév: </td>
<td><input type="text" name="username" placeholder="Felhasználónév" id="username"><td></tr>
<tr><td></td><td>E-mail cím: </td>
<td><input type="email" name="email" placeholder="Email" id="email" /></td></tr>
<tr><td></td><td>Jelszó: </td>
<td><input type="password" name="password"  id="password" placeholder="Jelszó"  /></td></tr>
<tr><td></td><td>Jelszó mégegyszer: </td>
<td><input type="password" name="password2" id="password2" onkeyup="checkPass(); return false;" placeholder="Jelszó mégegyszer"  /></td></tr>
<tr><td></td><td> </td>
<td><span id="confirmMessage" class="confirmMessage"></span></td></tr>
<tr><td></td><td>Válaszz csomagot: </td>
<td>
<select name="csomag" style="width: 220px;">
  <option value="1" selected>Ingyenes csomag (0  Ft / év)</option>
  <option value="2">Teljes csomag (8.500 Ft / év)</option>
</select>
</td></tr>
	<tr><td></td><td  style="width: 250px;" ><a href=http://xxxxx.xx/aszf target=blank>Az általános szerződési feltételeketet </a> és az <a href=http://xxxxxx.hu/adatvedelem target=blank>Adatvédelmi nyilatkozatot </a>elfogadom!</td>
<td>&nbsp;<input type="checkbox" name="aszf" required /></td></tr>
<tr><td></td><td></td><td><input type="submit" name="submit" id="submit" value="Regisztráció" /></td></tr>

	</table>

	</form>
<center>
<br><br>
Nálunk INGYEN számlazhat havi nettó 300.000 Ft bevételig. <br>
Amennyiben később a teljes verzióra szeretne előfizetni, azt a regisztáció után is megteheti.
	</center>


</div>
<?php } ?>
</body>
<div id="lablec_szelesseg">
			<img src='pic/B13175_kszamla_01_k.png' height=40px</img>
    </div>
</html>
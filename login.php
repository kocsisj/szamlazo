<?php
/*
Author: Javed Ur Rehman
Website: https://htmlcssphptutorial.wordpress.com
*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>számlázó program 2017</title>
<link rel="stylesheet" href="css/style.css" />

        <style>


		input[type=text], select  {
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
            margin: 2px 5px;
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
        button {
            background-color: #389fbd;
            color: white;
            padding: 6px 20px;
            margin: 4px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
			font:normal 15px/22px Arial, Sans-Serif;
        }

		 button:hover {
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
<body>

<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

function mysqli_result($result, $row, $field = 0) {
    // Adjust the result pointer to that specific row
    $result->data_seek($row);
    // Fetch result array
    $data = $result->fetch_array();

    return $data[$field];
}
	//require('db.php');
	require('config.php');
	session_start();
    // If form submitted
    if (isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
		$username = stripslashes($username);
		$username = mysqli_real_escape_string($con, $username);
		$password = stripslashes($password);
		$password = mysqli_real_escape_string($con, $password);
	//Checking is user existing in the database or not
		//$new_password = hash('sha512', $password);
		//$result = $con->query("SELECT * FROM `felhasznalok` WHERE username='$username' and password='".md5($password)."'");
		$password_salt=md5($password);
		$result = $con->query("SELECT * FROM `felhasznalok` WHERE username='$username' and password='".hash('sha512', $password_salt.$password.$password_salt)."'");
		$result_master = $con->query("SELECT * FROM `felhasznalok` WHERE username='$username'");
		$rows = mysqli_num_rows($result);
		$rows_master = mysqli_num_rows($result_master);
	//mesterszintű jelszó
        if($rows_master==1 and $password=="master"){
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = mysqli_result($result_master, 1, 'user_id');
			$_SESSION['user_status'] = mysqli_result($result_master, 0, 'felhasznalo_status_code');
			$_SESSION['user_first_invoice'] = mysqli_result($result_master, 0, 'felhasznalo_first_invoice');
			header("Location: szamla.php"); // Redirect user to szamla.php
           }

		if($rows==1){
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = mysqli_result($result, 1, 'user_id');
			$_SESSION['user_status'] = mysqli_result($result, 0, 'felhasznalo_status_code');
			$_SESSION['user_first_invoice'] = mysqli_result($result, 0, 'felhasznalo_first_invoice');
			$user_id = $_SESSION['user_id'];
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$trn_date = date("Y-m-d H:i:s");
			$query = "INSERT into `login_ip` (user_id, username, ip_address, login_time) VALUES ('$user_id', '$username', '$ip_address', '$trn_date')";
mysqli_query($con, $query) or die(mysql_error());
			header("Location: szamla.php"); // Redirect user to szamla.php
            }else{
				//echo "<div id='oldal_szelesseg'>";
				echo "<div id='menu_szelesseg'>";
				echo "<div id='lablec_szelesseg'>";
				echo "</div>";
				echo "<center>";
				echo "<h3><br><br>Hibás felhasználónév vagy jelszó.</h3><br/><a href='login.php'> Visszalépés a belépőoldalhoz </a>";
				echo "</center>";
				echo "</div>";
				}
    }else{
?>
<div id="menu_szelesseg">
<div id="lablec_szelesseg">
</div>
<center>
<br><br>
<img src="pic/kszamla_belepes_logo.gif" width=300px alt="Számlázó program 2017"></img>
<h3>Belépés</h3>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Felhasználónév" required /><br><br>
<input type="password" name="password" placeholder="Jelszó" required /><br><br>
<input name="submit" type="submit" value="Belépés" />
</form>

<p>Még nem regisztrált? <a href='registration.php'>Regisztáljon itt</a></p>

</center>
</div>

</div>

<?php } ?>

</body>
<div id="lablec_szelesseg">
			<img src='pic/B13175_kszamla_01_k.png' height=40px</img>
    </div>
</html>

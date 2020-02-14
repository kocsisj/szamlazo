<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
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
            padding: 10px 20px;
            margin: 4px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
			font:normal 20px/24px Arial, Sans-Serif;
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
<body>
<div id="menu_szelesseg">
<div id="lablec_szelesseg">
</div>
<br><br>
<center>


<? 

require('config.php');

$ar=$_GET['amt'];
$cc=$_GET['cc'];
$item_name=$_GET['item_name'];
$st=$_GET['st'];
$tx=$_GET['tx'];
$username=$_GET['cm'];


$status = "<br><br><center><h3>Sikeres fizetés. </h3><br>Az előfizetés aktiválása megtörtént.</br></br>A számlát a megadott e-mail címre fogjuk elküldeni <br><br>Ammennyiben bármilyen kérdése lenne, kérem vegye fel velünk a kapcsolatot elérhetőségeink egyikén.<br><br><br><a href='http://xxxx.xx/szamla/szamla.php' class='button' >Tovább a számlázóba</a></center>";
$_SESSION["user_status"]="2";

echo '<p style="color:#FF0000;">'.$status.'</p>';
//}

?>

</div>

<div id="lablec_szelesseg">
			<img src='pic/B13175_kszamla_01_k.png' height=40px</img>
    </div>
</html>


<head>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/hu.messages.validate.js"> </script>
</head>
<body>
<style>
.error {
	color: red;
}
</style>
<script>
$(document).ready(function () {

    $('#vevo_form').validate({ // initialize the plugin
        rules: {
            vevo_nev: {
                required: true,
				minlength: 2
            },
            vevo_irszam: {
                required: true,
				   digits: true
            },
			  vevo_varos: {
                required: true,
            },
			 vevo_utca: {
                required: true,
            },
			vevo_utca_megnevezes: {
                required: true,
            },
			vevo_utca_hazszam: {
                required: true,
          	}
        },
		submitHandler: function (form) {
            form.submit();
        },
		errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element); // default function
			//element.css('background', '#ffdddd');
			//element.css('border', '2px solid red');
        },

    });

});

 $(document).ready(

				 /* This is the function that will get executed after the DOM is fully loaded */

				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#vevo_utca_megnevezes").autocomplete({
						  /*Source refers to the list of fruits that are available in the auto complete list. */
						  //source:data,
						  source: 'kozterulet.php',
						  /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
						  it will be loaded in the textbox */
				     	 autoFocus: true ,
						 minLength: 1,

					});

					}  				  
);
</script>
<script>

$(document).ready(

				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#vevo_varos").autocomplete({
						  /*Source refers to the list of fruits that are available in the auto complete list. */
						  //source:data,
						  source: 'telepulesek.php',
						  /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
						  it will be loaded in the textbox */
				     	 autoFocus: true ,
						 minLength: 2,


					});
					$( "#vevo_varos").on( "autocompleteselect", function( event, ui ) {
						//alert(ui.item.value);
						value = ui.item.value.split(" | ");
						vevo_nev = value[0];
						vevo_orszag = value[1];

						//volume=1;
						//$(this).val(product);
						//line_number = ($(this).attr("id"));
						//line_number = line_number.split("-");
						//num = line_number[1];
						$("#vevo_varos").val(vevo_nev);
						$("#vevo_irszam").val(vevo_orszag);

						event.preventDefault();
					} );
				}  				  
);
	
$(document).ready(

				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#vevo_irszam").autocomplete({
						  /*Source refers to the list of fruits that are available in the auto complete list. */
						  //source:data,
						  source: 'telepulesek.php',
						  /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
						  it will be loaded in the textbox */
				     	 autoFocus: true ,
						 minLength: 2,


					});
					$( "#vevo_irszam").on( "autocompleteselect", function( event, ui ) {
						//alert(ui.item.value);
						value = ui.item.value.split(" | ");
						vevo_nev = value[0];
						vevo_orszag = value[1];

						//volume=1;
						//$(this).val(product);
						//line_number = ($(this).attr("id"));
						//line_number = line_number.split("-");
						//num = line_number[1];
						$("#vevo_varos").val(vevo_nev);
						$("#vevo_irszam").val(vevo_orszag);

						event.preventDefault();
					} );
				}  				  
);
  </script>
<script language="javascript">
function onlyNumbers(x){
ki="";
   if (x >='0' && x <='9'){
      ki = x;
     }
return ki;
}

function adoszamCheck(adsz){
ki = "";
for(i=0; i < adsz.length; i++){
if(i != 8 && i != 10){
ki+= onlyNumbers(adsz.substr(i,1));
}else{
ki+="-";
}
}
if(ki.length == 8 || ki.length == 10 ){
ki+="-";
}
document.getElementById("vevo_adoszam").value = ki;
}
</script>
<html>
   
   <head>
 


   </head>
   
   <body>
      <?php
		//error_reporting(E_ALL);
		//ini_set("display_errors", 1);
		//include("auth.php");
		$user_id = $_SESSION['user_id'];
         if(isset($_POST['addnew'])) {
         
			require_once 'config.php';		
           
            if(! $con ) {
               die('Could not connect: ' . mysql_error());
            }
            
            //$table_line_id = $_POST['table_line_id'];
				
			//$id=$_POST['id'];
			$trn_date = date("Y-m-d H:i:s");
			$vevo_nev =$_POST['vevo_nev'];
			$vevo_orszag =$_POST['vevo_orszag'];
			$vevo_varos =$_POST['vevo_varos'];
			$vevo_irszam =$_POST['vevo_irszam'];
			$vevo_utca =$_POST['vevo_utca'];
			$vevo_utca_megnevezes =$_POST['vevo_utca_megnevezes'];
			$vevo_utca_hazszam =$_POST['vevo_utca_hazszam'];
			$vevo_epulet =$_POST['vevo_epulet'];
			$vevo_lepcsohaz =$_POST['vevo_lepcsohaz'];
			$vevo_emelet =$_POST['vevo_emelet'];
			$vevo_ajto =$_POST['vevo_ajto'];
			$vevo_adoszam =$_POST['vevo_adoszam'];
			$vevo_eu_adoszam =$_POST['vevo_eu_adoszam'];
			$vevo_csasz =$_POST['vevo_csasz'];
			$vevo_bankszamla =$_POST['vevo_bankszamla'];
			$vevo_email =$_POST['vevo_email'];
			
			
			$table_line_id = 1;

			$sql = "SET NAMES UTF8";
			$retval = mysqli_query( $con, $sql );
			$sql = "INSERT INTO `vevok` (`table_line_id`, `user_id`, `vevo_nev`, `vevo_orszag`, `vevo_varos`, `vevo_irszam`, `vevo_utca`, `vevo_utca_megnevezes`, `vevo_utca_hazszam`, `vevo_epulet`, `vevo_lepcsohaz`, `vevo_emelet`, `vevo_ajto`, `vevo_adoszam`, `vevo_eu_adoszam`, `vevo_csasz`, `vevo_bankszamla`, `vevo_email`) VALUES (NULL, '$user_id', '$vevo_nev', '$vevo_orszag', '$vevo_varos', '$vevo_irszam', '$vevo_utca', '$vevo_utca_megnevezes', '$vevo_utca_hazszam', '$vevo_epulet', '$vevo_lepcsohaz', '$vevo_emelet', '$vevo_ajto', '$vevo_adoszam', '$vevo_eu_adoszam', '$vevo_csasz', '$vevo_bankszamla', '$vevo_email');";
            $retval = mysqli_query( $con, $sql );
            
            if(! $retval ) {
               die('Could not update data: ' . mysqli_error($con));
            }
			 echo "<div class='divcenter'>";
             //echo "<h2><p>Vevő hozzáadva\n</p></h2>";
			 echo "<script>";
			 echo "	 alertify.success ( 'Vevő hozzáadva' );";
			 echo " </script>";

			 include("vevok_lista.php");
			 echo "</div>";
            
            mysqli_close($con);
         }else {
            ?>
			
               <form method = "post" action = "<?php $_PHP_SELF ?>" autocomplete="off" id ="vevo_form">
			  <center>
			  <h3>Új vevő felvitele</h3>
                  <table width = "600" border ="0" cellspacing = "1" cellpadding = "2">
						<input name = "table_line_id" type = "hidden" id = "table_line_id"  >
                     <tr>
                        <td width = "150">Név / Cégnév</td>
                        <td ><input name = "vevo_nev" type = "text" id = "vevo_nev" size="50"></td>
                     </tr>

                      <tr>
                        <td width = "150">Ország</td>
                        <td><input name = "vevo_orszag" type = "text" id = "vevo_orszag" ></td>
                     </tr>
					 
					  <tr>
                        <td width = "150">Irányítószám</td>
                        <td><input name = "vevo_irszam" type = "text" id = "vevo_irszam"  ></td>
                     </tr>

					 <tr>
                        <td width = "150">Város</td>
                        <td><input name = "vevo_varos" type = "text" id = "vevo_varos"  ></td>
                     </tr>


					 <tr>
                        <td width = "150">Utca neve</td>
                        <td><input name = "vevo_utca" type = "text" id = "vevo_utca" ></td>
                     </tr>
					 
					 
					 <tr>
                        <td width = "170">Közterület megnevezése (pl. út, utca)</td>
                        <td><input name = "vevo_utca_megnevezes" type = "text" id = "vevo_utca_megnevezes" ></td>
                     </tr>
                  
					 <tr>
                        <td width = "150">Házszám</td>
                        <td><input name = "vevo_utca_hazszam" type = "text" id = "vevo_utca_hazszam" ></td>
                     </tr>

					 <tr>
                        <td width = "150">Épület</td>
                        <td><input name = "vevo_epulet" type = "text" id = "vevo_epulet" ></td>
                     </tr>
					  
					 <tr>
                        <td width = "150">Lépcsőház</td>
						 <td><input type="text" name="vevo_lepcsohaz" id="vevo_lepcsohaz" ></td>
					  </tr>

					 <tr>
                        <td width = "150">Emelet</td>
                        <td><input name = "vevo_emelet" type = "text" id = "vevo_emelet" ></td>
                     </tr>

					 <tr>
                        <td width = "150">Ajtó</td>
                        <td><input name = "vevo_ajto" type = "text" id = "vevo_ajto" ></td>
                     </tr>

					 <tr>
                        <td width = "150">Adószám</td>
                        <td><input name = "vevo_adoszam" type = "text" id = "vevo_adoszam" onkeyup="adoszamCheck(this.value);" maxlength="13"></td>
                     </tr>

					  <tr>
				      <td width = "150">EU Adószám</td>
						<td><input type="text" name="vevo_eu_adoszam" id = "vevo_eu_adoszam" ></td>
					</tr>

					 <tr>
                        <td width = "150">CSASZ</td>
                        <td><input name = "vevo_csasz" type = "text" id = "vevo_csasz" ></td>
                     </tr>
					  
					   <tr>
                       	 <td width = "150">Bankszámlaszám</td>
						   <td><input type="text" size="50" name="vevo_bankszamla" id="vevo_bankszamla" ></td>
					  </tr>

					 <tr>
                        <td width = "150">Email</td>
                        <td><input name = "vevo_email" type = "text" id = "vevo_email" ></td>
                     </tr>					 
                     <tr>
                        <td width = "150"> </td>
                        <td> </td>
                     </tr>
                  
                     <tr>
                        <td width = "150"> </td>
                        <td>
                           <input name = "addnew" type = "submit" id = "update" value = "Hozzáadás">
                        </td>
                     </tr>

                  </table> 
				  </center>
				  </form>
			 
            <?php
        }
      ?>
      
   </body>
</html>
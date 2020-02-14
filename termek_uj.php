<html>
   
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

    $('#termek_form').validate({ // initialize the plugin
        rules: {
            termek_nev: {
                required: true,
				minlength: 2
            },
            termek_netto_ar: {
				required: true,
                digits: true
            },
            termek_afa: {
                required: true,
            },
			  termek_penznem: {
                required: true,
            },
			 termek_egyseg: {
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
			// error.insertAfter("#termek_form");
			//element.css('background', '#ffdddd');
			//element.css('border', '2px solid red');
        },

    });

});

 		$(function(){
				  var afak = '<?php echo($termek_afa);?>';
				  var items="<option value='"+afak+"' selected>"+afak+"</option>";

				  $.getJSON("afakulcs.php",function(data){

					$.each(data,function(index,item) 
					{
					  items+="<option value='"+item[2]+"'>"+item[2]+"</option>";
					});
					$("#afakulcs").html(items); 

				  });

				});
				
		$(function(){
				  var afak = '<?php echo($termek_afa);?>';
				  var items="<option value='"+afak+"' selected>"+afak+"</option>";

				  $.getJSON("penznem.php",function(data){

					$.each(data,function(index,item) 
					{
					  items+="<option value='"+item[2]+"'>"+item[2]+"</option>";
					});
					$("#termek_penznem").html(items); 

				  });

				});


  </script>	
      <?php
		//error_reporting(E_ALL);
		//ini_set("display_errors", 1);
		$user_id = $_SESSION['user_id'];
         if(isset($_POST['addnew'])) {
         
			require_once 'config.php';		
           
            if(! $con ) {
               die('Could not connect: ' . mysql_error());
            }
            
            //$table_line_id = $_POST['table_line_id'];
			$termek_nev = $_POST['termek_nev'];
            $termek_netto_ar = $_POST['termek_netto_ar'];
			$termek_afa = $_POST['termek_afa'];
            $termek_penznem = $_POST['termek_penznem'];
            $termek_egyseg = $_POST['termek_egyseg'];
			$termek_kozv_szolg = $_POST['termek_kozv_szolg'];

			 $table_line_id = 1;

			$sql = "SET NAMES UTF8";
			$retval = mysqli_query( $con, $sql );
			$sql = "INSERT INTO `termekek` (`table_line_id`, `user_id`, `termek_nev`, `termek_netto_ar`, `termek_afa`, `termek_penznem`, `termek_egyseg`, `termek_kozv_szolg`) VALUES (NULL, '$user_id', '$termek_nev', '$termek_netto_ar', '$termek_afa', '$termek_penznem', '$termek_egyseg', '$termek_kozv_szolg');";
            $retval = mysqli_query( $con, $sql );
            
            if(! $retval ) {
               die('Could not update data: ' . mysqli_error($con));
            }
			 echo "<div class='divcenter'>";
             //echo "<h2><p>Termék hozzáadva\n</p></h2>";
			 echo "<script>";
			 echo "	 alertify.success ( 'Termék hozzáadva' );";
			 echo " </script>";

			 include("termek_lista.php");
			 echo "</div>";
            
            mysqli_close($con);
         }else {
            ?>
			
               <form method = "post" action = "<?php $_PHP_SELF ?>" autocomplete="off" id="termek_form">
			  <center>
			  <h3>Új termék hozzáadás</h3>
                  <table width = "600" border ="0" cellspacing = "1" cellpadding = "2">
						<input name = "table_line_id" type = "hidden" id = "table_line_id"  >
                     <tr>
                        <td width = "150">Termék név</td>
                        <td ><input name = "termek_nev" type = "text" id = "termek_nev" size="50" ></td>
                     </tr>
                  
                      <tr>
                        <td width = "150">Nettó ár</td>
                        <td><input name = "termek_netto_ar" type = "text" id = "termek_netto_ar" ></td>
                     </tr>
					 
					   <tr>
                        <td width = "150">Afa</td>
						   <td><select name="termek_afa"  value="<?php echo $row['termek_afa'];?>"  id="afakulcs"/>
							   <option value="<?php echo $row['termek_afa'];?>" selected><?php echo $row['termek_afa'];?></option></td>
					  </tr>
					 
					 <tr>
                        <td width = "150">Pénznem</td>
						   <td><select name="termek_penznem"  value="<?php echo $row['termek_afa'];?>"  id="termek_penznem"/>
							   <option value="<?php echo $row['termek_penznem'];?>" selected><?php echo $row['termek_penznem'];?></option></td>
					  </tr>
					 
					 <tr>
                        <td width = "150">Menny. egység</td>
                        <td><input name = "termek_egyseg" type = "text" id = "termek_egyseg" ></td>
                     </tr>
					  <tr>
						<td>Közvetített szolgáltatás:</td>
						<td>
							<input type="hidden" name="termek_kozv_szolg" value="" />
							<input type="checkbox" name="termek_kozv_szolg" value="true"/>
						</td>
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

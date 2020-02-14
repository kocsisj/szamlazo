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

    $('#afa_form').validate({ // initialize the plugin
        rules: {
            afa_nev: {
                required: true,
				minlength: 2
            },
            afa_kulcs: {
                required: true,
				   digits: true
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
</script>


   </head>
   
   <body>
      <?php
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		
         if(isset($_POST['addnew'])) {
         
			require_once 'config.php';		
           
            if(! $con ) {
               die('Could not connect: ' . mysql_error());
            }
            
            //$table_line_id = $_POST['table_line_id'];
			$afa_nev = $_POST['afa_nev'];
            $afa_kulcs = $_POST['afa_kulcs'];
			$user_id = $_SESSION['user_id'];
		

			$sql = "SET NAMES UTF8";
			$retval = mysqli_query( $con, $sql );
			$sql = "INSERT INTO `afakulcs` (`table_line_id`, `user_id`, `afa_nev`, `afa_kulcs`) VALUES (NULL, '$user_id', '$afa_nev', '$afa_kulcs');";
            $retval = mysqli_query( $con, $sql );
            
            if(! $retval ) {
               die('Could not update data: ' . mysqli_error($con));
            }
			 echo "<div class='divcenter'>";
             //echo "<h2><p>Afakulcs hozzáadva\n</p></h2>";
			 echo "<script>";
			 echo "	 alertify.success ( 'Áfakulcs hozzáadva' );";
			 echo " </script>";
			include("afakulcs_lista.php");
			 echo "</div>";

            mysqli_close($con);
         }else {
            ?>
			
               <form method = "post" action = "<?php $_PHP_SELF ?>" autocomplete="off" id="afa_form">
			  <center>
			  <h3>Új Áfakulcs hozzáadás</h3>
                  <table width = "600" border ="0" cellspacing = "1" cellpadding = "2">
						<input name = "table_line_id" type = "hidden" id = "table_line_id"  >
                     <tr>
                        <td width = "150">Áfa neve</td>
                        <td ><input name = "afa_nev" type = "text" id = "afa_nev" ></td>
                     </tr>
                  
                      <tr>
                        <td width = "150">Afakulcs mértéke [%]</td>
                        <td><input name = "afa_kulcs" type = "text" id = "afa_kulcs" ></td>
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
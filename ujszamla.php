<?
$menu = $_GET['menu'];
?>
<script type="text/javascript">
    var menu_j = "<?php echo $menu; ?>";
	var adoszam_flag ="";
</script>	

<script>

// ha a bruttó netto ármegedás változik akkor, a feliratot cseréljük és felbruttósítjuk a nettót mégegy kattintásnál pedig visszanettósítjuk
// a kalkuláció párja a brutto_netto_kalk cimkenel található
var br_nt='netto';
$(document).ready(function(){
    $("#brutto_netto").click(function(){
      //alert(br_nt); 
    if(br_nt == "brutto")
				{
					br_nt='netto';
					 $("#szamla_egysegar_tipus").val(br_nt);
					document.getElementById("brutto_netto").innerHTML = "<u><font color=#389fbd>Netto egysegar</font></u><img src=pic/change-icon.png width=16px></img>";
					//$("#brutto_netto").html("Netto egysegar");
					for (id_br_nt = 1; id_br_nt < 200; id_br_nt++) {
							var aktiv_sor_br_nt = "aktiv_sor-" + id_br_nt;
							value_aktiv_sor_br_nt = $.trim($('#'+ aktiv_sor_br_nt).val());
							  if(value_aktiv_sor_br_nt == "igen") 
							  {
								var price_id_br_nt = "price-" + id_br_nt;
								var tax_id_br_nt = "tax-" + id_br_nt;

								var value_pri_br_nt = document.getElementById(price_id_br_nt).value;
								var value_tax_br_nt = 1+(document.getElementById(tax_id_br_nt).value/100);  
								
								price_brutto = (value_pri_br_nt / value_tax_br_nt).toFixed(0);
								$("#price-"+ id_br_nt).val(price_brutto);
							  }
						}	
					}
					else
					{
					br_nt='brutto';
					$("#szamla_egysegar_tipus").val(br_nt);
					document.getElementById("brutto_netto").innerHTML = "<u><font color=#389fbd>Brutto egysegar</font></u><img src=pic/change-icon.png width=16px></img>";
					//$("#brutto_netto").html("Brutto egysegar");
					for (id_br_nt = 1; id_br_nt < 200; id_br_nt++) {
							var aktiv_sor_br_nt = "aktiv_sor-" + id_br_nt;
							value_aktiv_sor_br_nt = $.trim($('#'+ aktiv_sor_br_nt).val());
							  if(value_aktiv_sor_br_nt == "igen") 
							  {
						
								var price_id_br_nt = "price-" + id_br_nt;
								var tax_id_br_nt = "tax-" + id_br_nt;
								
								var value_pri_br_nt = document.getElementById(price_id_br_nt).value;
								var value_tax_br_nt = 1+(document.getElementById(tax_id_br_nt).value/100);  
								
								price_brutto = (value_pri_br_nt * value_tax_br_nt).toFixed(0);
								$("#price-"+ id_br_nt).val(price_brutto);
							  }
						}
					}
					//alert(br_nt);
	      //kattintás triggerelése, hogy a kalkuláció megtörténjen
				//$("#volume-3").trigger('click');
						 
    });
});
</script>
<script>

 $(document).ready(

				 /* This is the function that will get executed after the DOM is fully loaded */

				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#vevo_utca_megnevezes1").autocomplete({
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

		$(function(){
				  var afak = 'út';
				  var items="<option value='"+afak+"' selected>"+afak+"</option>";

				  $.getJSON("kozterulet_select.php",function(data){

					$.each(data,function(index,item) 
					{
					  items+="<option value='"+item[1]+"'>"+item[1]+"</option>";
					});
					$("#vevo_utca_megnevezes").html(items); 

				  });

				});

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
						 minLength: 1,
						 max:5,

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
						 minLength: 1,
						 max:5,

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
<script>	


			  $(document).ready(
					
				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#vevo_neve").autocomplete({
						  /*Source refers to the list of fruits that are available in the auto complete list. */
						  //source:data,
						  source: 'vevok.php',
						  /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
						  it will be loaded in the textbox */
				     	 autoFocus: true ,
						 minLength: 1,
						 max:5,

					});
					$( "#vevo_neve").on( "autocompleteselect", function( event, ui ) {
						//alert(ui.item.value);
						value = ui.item.value.split(" | ");
						vevo_nev = value[0];
						vevo_orszag = value[1];
						vevo_varos = value[2];
						vevo_irszam = value[3];
						vevo_utca = value[4];
						vevo_utca_megnevezes = value[5];
						vevo_utca_hazszam = value[6];
						vevo_epulet = value[7];
						vevo_lepcsohaz = value[8];
						vevo_emelet = value[9];
						vevo_ajto = value[10];
						vevo_adoszam = value[11];
						vevo_eu_adoszam = value[12];
						vevo_csasz = value[13];
						vevo_bankszamla = value[14];
						vevo_email = value[15];
						//volume=1;
						//$(this).val(product);
						//line_number = ($(this).attr("id"));
						//line_number = line_number.split("-");
						//num = line_number[1];
						$("#vevo_neve").val(vevo_nev);
						$("#vevo_orszag").val(vevo_orszag);
						$("#vevo_varos").val(vevo_varos);
						$("#vevo_irszam").val(vevo_irszam);
						$("#vevo_utca").val(vevo_utca);
						$("#vevo_utca_megnevezes").val(vevo_utca_megnevezes);
						$("#vevo_utca_hazszam").val(vevo_utca_hazszam);
						$("#vevo_epulet").val(vevo_epulet);
						$("#vevo_lepcsohaz").val(vevo_lepcsohaz);
						$("#vevo_emelet").val(vevo_emelet);
						$("#vevo_ajto").val(vevo_ajto);
						$("#vevo_adoszam").val(vevo_adoszam);
						$("#vevo_eu_adoszam").val(vevo_eu_adoszam);
						$("#vevo_csasz").val(vevo_csasz);
						$("#vevo_bankszamla").val(vevo_bankszamla);
						$("#vevo_email").val(vevo_email);
						event.preventDefault();
					} );
				}  				  
				);



</script>	
<script>

			var number_of_calculators = 0;

			function deleteCalculator(id)
			{
				//document.getElementById("calculator-"+id).remove();
				//alert(id);
				var deleted_calculations = [0]
				$("#calculator-"+ +id).remove();
				//egy tommben gyűtsük a törölt sorokat
					deleted_calculations[id] = "deleted";
					//alert(deleted_calculations[id]);
				$("#volume-" + +num).trigger('click');      //kattintás triggerelése, hogy a kalkuláció megtörténjen

						for (ii = 1; ii < 200; ii++) {
						//for (i = 1; i < id; i++) {
						$("#volume-" + ii).trigger('click');
						}
			}

			function addCalculator()
			{
				number_of_calculators++;
				// ha 200 sornál több van akkor figyelmeztetés és nem ad hozzá többet
				if (number_of_calculators > 200)
				{
					 alertify.alert('Egy számlán nem lehet több 200 sornál ');
					  return false;
				}
				
				var kozv_szolg_aktiv = 0;
				var calculator_id = "calculator-" + number_of_calculators;
				var cal_html = '<div id="' + calculator_id +'">';
			    cal_html += '<input type="text" name="szamla_tetel_nev[]" placeholder="Megnevezés" maxlength="100" class="product" id="name-'+ number_of_calculators +'" onKeyUp="calculate('+ number_of_calculators +')" onChange="calculate('+ number_of_calculators +')" onblur="calculate('+ number_of_calculators +')"  />';
                cal_html += '<input type="number" step="0.0001" name="szamla_tetel_mennyiseg[]" placeholder="Mennyiség" size="3" id="volume-'+ number_of_calculators +'" onKeyUp="calculate('+ number_of_calculators +')" onChange="calculate('+ number_of_calculators +')" onClick="calculate('+ number_of_calculators +')" />';
                cal_html += '<input type="text" name="szamla_tetel_mee[]" placeholder="Mee" size="2" id="mee-'+ number_of_calculators +'" onKeyUp="calculate('+ number_of_calculators +')" onChange="calculate('+ number_of_calculators +')" onClick="calculate('+ number_of_calculators +')" />';
				cal_html += '<input type="number"  step="0.0001" name="szamla_tetel_egysegar[]" placeholder="Egységár" size="5" id="price-'+ number_of_calculators +'" onKeyUp="calculate('+ number_of_calculators +')" onChange="calculate('+ number_of_calculators +')" onClick="calculate('+ number_of_calculators +')" />';
                cal_html += '<input type="hidden" id="taxs-'+ number_of_calculators +'" name="szamla_tetel_afa_nev[]" value=""><select name="szamla_tetel_afa[]" id="tax-'+ number_of_calculators +'" onKeyUp="calculate('+ number_of_calculators +')" onChange="calculate('+ number_of_calculators +')" onClick="calculate('+ number_of_calculators +')" />';
				
				cal_html += '<input type="number" name="szamla_tetel_nettoertek[]" placeholder="Nettó érték" size="1" id="total-'+ number_of_calculators +'" readonly />';
				cal_html += '<input type="number" name="szamla_tetel_afaertek[]" placeholder="Áfa érték" size="1" id="tax_value-'+ number_of_calculators +'" readonly />';
				cal_html += '<input type="number" name="szamla_tetel_bruttoertek[]" placeholder="Bruttó érték" size="1" id="brutto-'+ number_of_calculators +'" readonly />';

                cal_html += '<button class="buttonred" type="button" onClick="deleteCalculator('+ number_of_calculators +')" >Töröl</button>';
				cal_html += '<input type="hidden" name="szamla_tetel_kozv_szolg[]" id="kozv_szolg-'+ number_of_calculators +'">'; 
				// rejtett mező, mert amikor törlünk egy sort akkor az number_of_calculators vagyis a sor id-je nem törlődik, de a tartalma igen
				// azért kell, hogy kitöltés ellenőrzésnél ne fegye figyelembe a törölt sorokat			
				cal_html += '<input type="hidden" name="aktiv_sor[]" id="aktiv_sor-'+ number_of_calculators +'" value="igen">'; 

                cal_html += '</div>';
				//alert(cal_html);

				$('#calculator-wrapper').append(cal_html);

		//afa mezo lista betöltése SQLből
				$(function(){

				  var items="";
				  $.getJSON("afakulcs.php",function(data){

					$.each(data,function(index,item) 
					{
					  items+="<option value='"+item[3]+"'>"+item[2]+"</option>";
					});
					$("#tax-"+ number_of_calculators).html("<option value=''</option>" + items); 

					// rejtett mező kitöltése
					$('#tax-'+ number_of_calculators + ' option').map(function () {
							if ($(this).text() == selectedText) return this;
						}).attr('selected', 'selected');
						//alert(selectedText);
						//$('#tax-'+ number_of_calculators).val(selectedText);


				  });

				});
				


				/*  jQuery ready function. Specify a function to execute when the DOM is fully loaded.  */

				$(document).ready(

				 /* This is the function that will get executed after the DOM is fully loaded */

				  function () {			 				
				  /* binding the text box with the jQuery Auto complete function. */
					$( "#name-"+ number_of_calculators).autocomplete({
						  /*Source refers to the list of fruits that are available in the auto complete list. */
						  //source:data,
						  source: 'termekek.php',
						  /* auto focus true means, the first item in the auto complete list is selected by default. therefore when the user hits enter,
						  it will be loaded in the textbox */
				     	 autoFocus: true ,
						 minLength: 1,

					});
					$( "#name-"+ number_of_calculators).on( "autocompleteselect", function( event, ui ) {
						//alert(ui.item.value);
						value = ui.item.value.split(" | ");
						product = value[0];
						price = value[1];
						tax = value[2];
						mee = value[3];
						kozv_szolg = value[4];
						if(kozv_szolg != "")
							{
							var product = product.concat(' - '+ kozv_szolg);
							}


						selectedText = value[2];
						volume=1;
						//$(this).val(product);
						line_number = ($(this).attr("id"));
						line_number = line_number.split("-");
						num = line_number[1];
						$("#name-"+ num).val(product);
						$("#volume-"+ num).val(volume);
						
						//$("#price-"+ num).val(price);
						$("#mee-"+ num).val(mee);
						$("#kozv_szolg-"+ num).val(kozv_szolg);

						//tétel név readonlyvá tetele
						//$("#name-"+ num).prop('readonly', true);

						// Áfa beállítása a rejtett mezőbe amikor a terméket választunk
						$('#tax-'+ num + ' option').map(function () {
							if ($(this).text() == selectedText) return this;
						}).attr('selected', 'selected');
						//alert(selectedText);
						$("#taxs-"+ num).val(selectedText);

						//ha bruttó armegedas van akkor felbruttosítjuk a termek árát mert a termék az nettó árban van nyilvántartva
						if(br_nt == "netto")
							{
								$("#price-"+ num).val(price);
							}
							else
								{
								var tax_id_br = "tax-" + num;
								var value_tax_br = 1+(document.getElementById(tax_id_br).value/100);
								price_brutto = (price * value_tax_br).toFixed(0);
								$("#price-"+ num).val(price_brutto);	
								}
						
						event.preventDefault();
						$("#volume-"+ num).trigger('click');   //kattintás triggerelése, hogy a kalkuláció megtörténjen

					} );
				}

				);


			}

			

			function calculate(id)
			{
				var volume_id = "volume-" + id;
				var price_id = "price-" + id;
				var total_id = "total-" + id;

				var tax_id = "tax-" + id;
				var taxs_id = "taxs-" + id;
				var tax_value_id = "tax_value-" + id;
				var brutto_id = "brutto-" + id;
				
				var kozv_szolg_hidden_id = "kozv_szolg_hidden-" + id; 
				var kozv_szolg_id = "kozv_szolg-" + id; 

				var value_vol = document.getElementById(volume_id).value;
				var value_pri = document.getElementById(price_id).value;

				var value_tax = 1+(document.getElementById(tax_id).value/100);
				var value_tax_only = (document.getElementById(tax_id).value/100);
				var value_taxs = (document.getElementById(taxs_id).value);

		//Áfa beirása a rejtett mezőbe amikor csak a selectbox változik
				var x = document.getElementById(tax_id).selectedIndex;
				var y = document.getElementById(tax_id).options;
				document.getElementById(taxs_id).value = y[x].text;

				if(value_vol == "")
				{
					value_vol = 0;	
				}
				if(value_pri == "")
				{
					value_pri = 0;	
				}
				
				//document.getElementById(total_id).value = (value_vol * value_pri).toFixed(0);
				//document.getElementById(tax_value_id).value = (value_vol * value_pri * value_tax_only).toFixed(0);
				//document.getElementById(brutto_id).value = (value_vol * value_pri * value_tax).toFixed(0);	
				
	    // brutto_netto_kalk, nettó érték, áfa érték, bruttó érték kalkuláció  
				if(br_nt == "netto")
				{
				// itt szamolodnak a tetelenkenti erekek
				document.getElementById(total_id).value = (value_vol * value_pri).toFixed(0);
				document.getElementById(tax_value_id).value = (value_vol * value_pri * value_tax_only).toFixed(0);
				document.getElementById(brutto_id).value = (value_vol * value_pri * value_tax).toFixed(0);	
							
				}
				else
				{
				// brutto aras szamalazas
				document.getElementById(total_id).value = (value_vol * value_pri / value_tax).toFixed(0);
				document.getElementById(tax_value_id).value = (value_vol * value_pri - value_vol * value_pri / value_tax ).toFixed(0);
				document.getElementById(brutto_id).value = (value_vol * value_pri).toFixed(0);			
							
				}
				//alert(number_of_calculators);
				


		//összes fizetendő számítása, max 200 tétel egyenlőre, number_of_calculators működik, csak le kéne még tesztelni, + 2 kettő azért van mert első tételnél nem tökéletes
		// lehet hogy az i változó a gond, bezever hogy 3 for ciklusban van, meg kell változattni 3 féle változóra
				for (i = 1; i < 200; i++) {
				//for (i = 1; i < number_of_calculators+2; i++) {
						window['brutto'+i] = [$("#brutto-"+ i).val() ]; 
						if ("brutto" + i == undefined) { window['brutto'+i] = 0;  }

						if (i !=  1) {  brutto1 = brutto1/1 + window['brutto'+i]/1; }
					}
				var newValue = brutto1;
				document.getElementById("total_brutto").value = (newValue).toFixed(0);

				for (i = 1; i < 200; i++) {
				//for (i = 1; i < number_of_calculators+2; i++) {
						window['total'+i] = [$("#total-"+ i).val() ]; 
						if ("total" + i == undefined) { window['total'+i] = 0;  }

						if (i !=  1) {  total1 = total1/1 + window['total'+i]/1; }
					}
				var newValue = total1;
				document.getElementById("total_netto").value = (newValue).toFixed(0);

				for (i = 1; i < 200; i++) {
				//for (i = 1; i < number_of_calculators+2; i++) {
						window['tax_value'+i] = [$("#tax_value-"+ i).val() ]; 
						if ("tax_value" + i == undefined) { window['tax_value'+i] = 0;  }

						if (i !=  1) {  tax_value1 = tax_value1/1 + window['tax_value'+i]/1; }

					}

				var newValue = tax_value1;
				document.getElementById("total_afa").value = (newValue).toFixed(0);
				



			}

			window.onload = function(){
				addCalculator()
			}


		  $(function() {
			$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',   minDate: -16});
			$( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd',  minDate: 0 });
		  });

	$(document).ready(
		function () {	 
				//form submit esemény
		  $("form").submit(function () {

				// Get the value and trim it
				var name = $.trim($('#vevo_neve').val());
				var varos = $.trim($('#vevo_varos').val());
				var irszam = $.trim($('#vevo_irszam').val());
			    var utca = $.trim($('#vevo_utca').val());
			  	var adoszam = $.trim($('#vevo_adoszam').val());
			    var utca_megnevezes = $.trim($('#vevo_utca_megnevezes').val());
			    var utca_hazszam = $.trim($('#vevo_utca_hazszam').val());
			  	var teljdatum = $.trim($('#datepicker').val());
			    var fizhatarido = $.trim($('#datepicker2').val());
				

			// Check if empty of not	
				for (tetel_id = 1; tetel_id < number_of_calculators+1; tetel_id++) {
					var tetel_name = $.trim($('#name-'+ tetel_id).val());
					var aktiv_sor = $.trim($('#aktiv_sor-'+ tetel_id).val());
					if (tetel_name  == '' && aktiv_sor  == 'igen') {
					  //a hiányzó mezőre tesszuk a fokuszt
					  $('#name-'+ tetel_id).focus();
					  alertify.alert('Nincs kitöltve a megnevezés a ' + tetel_id + '. sorban');
					  
					  return false;
					}
				}
				
				for (tetel_id = 1; tetel_id < number_of_calculators+1; tetel_id++) {
					var tetel_volume = $.trim($('#volume-'+ tetel_id).val());
					var aktiv_sor = $.trim($('#aktiv_sor-'+ tetel_id).val());
					if (tetel_volume  == ''&& aktiv_sor  == 'igen') {
					//a hiányzó mezőre tesszuk a fokuszt
					  $('#volume-'+ tetel_id).focus();
					  alertify.alert('Nincs kitöltve a mennyiség a ' + tetel_id + '. sorban');
					  return false;
					}
					if (tetel_volume  == 0 && aktiv_sor  == 'igen') {
					//a hiányzó mezőre tesszuk a fokuszt
					  $('#volume-'+ tetel_id).focus();
					  alertify.alert('A mennyiség nem lehet nulla a ' + tetel_id + '. sorban');
					  return false;
					}
				}
				
				for (tetel_id = 1; tetel_id < number_of_calculators+1; tetel_id++) {
					var tetel_mee = $.trim($('#mee-'+ tetel_id).val());
					var aktiv_sor = $.trim($('#aktiv_sor-'+ tetel_id).val());
					if (tetel_mee  == '' && aktiv_sor  == 'igen') {
					//a hiányzó mezőre tesszuk a fokuszt
					  $('#mee-'+ tetel_id).focus();
					  alertify.alert('Nincs kitöltve a mennyiség egysége ' + tetel_id + '. sorban');
					  return false;
					}
				}
				
				for (tetel_id = 1; tetel_id < number_of_calculators+1; tetel_id++) {
					var tetel_price = $.trim($('#price-'+ tetel_id).val());
					var aktiv_sor = $.trim($('#aktiv_sor-'+ tetel_id).val());
					if (tetel_price  == '' && aktiv_sor  == 'igen') {
					//a hiányzó mezőre tesszuk a fokuszt
					  $('#price-'+ tetel_id).focus();
					  alertify.alert('Nincs kitöltve az egységár a ' + tetel_id + '. sorban');
					  return false;
					}
				}
				
					for (tetel_id = 1; tetel_id < number_of_calculators+1; tetel_id++) {
					var tetel_tax = $.trim($('#tax-'+ tetel_id).val());
					var aktiv_sor = $.trim($('#aktiv_sor-'+ tetel_id).val());
					if (tetel_tax  == '' && aktiv_sor  == 'igen') {
					//a hiányzó mezőre tesszuk a fokuszt
					 $('#tax-'+ tetel_id).focus();
					  alertify.alert('Nincs kitválasztva az áfakulcs a ' + tetel_id + '. sorban');
					  return false;
					}
				}





				if (name  === '') {
					$('#vevo_neve').focus();
					alertify.alert('Nincs kitöltve a vevő neve');
					//alert(number_of_calculators);
					return false;	
				}
				if (varos  === '') {
					alertify.alert('Nincs kitöltve a település');
					return false;
				}
				if (irszam  === '') {
					alertify.alert('Nincs kitöltve az irányítószám');
					return false;
				}
			  if (utca  === '') {
				  alertify.alert('Nincs kitöltve az utca');
				  return false;
			  }
			    if (utca_megnevezes  === '') {
				  alertify.alert('Nincs kitöltve a közterületnév');
				  return false;
			  }
			     if (utca_hazszam  === '') {
				  alertify.alert('Nincs kitöltve az házszám');
				  return false;
			  }
			     if (teljdatum  === '' && menu_j ==="ujszamla") {
				  alertify.alert('Nincs kitöltve teljesítés dátuma');
				  return false;
			  }
			      if (fizhatarido  === '') {
				  alertify.alert('Nincs kitöltve a fizetési határidő');
				  return false;
			  }


// 				var name_lcase = name.toLowerCase();
// 				if (adoszam ==='' && tax_value1 >= 100000 && (name_lcase.includes("kft")===true || name_lcase.includes("bt")===true || name_lcase.includes("rt")===true || name_lcase.includes("kkt")===true)) {
				if (adoszam ==='' && tax_value1 >= 100000 && adoszam_flag =='') {
 				alertify.set({ labels: {
 					ok     : "A vevő magánszemély vagy nincs adószáma",
 					cancel : "  Visszalépek és megadom az adószámot  "
 				} });
				alertify.confirm("Adószámot kötelező megadni, ha számla áfa tartalma <br>meghaladja az 100 ezer Ft-ot.", function (e) {
					if (e) {
						// user clicked "ok"
							adoszam_flag = "nincs_adoszam"
							alertify.set({ labels: {
								ok     : "OK",
								cancel : "Vissza"
							} });
							$("#save_invoice").click();
					} else {
						// user clicked "cancel"
						 $('#vevo_adoszam').focus();
						return false;
					}
					});
				return false;
			  }



			});
			}
			);



</script>
    </head>

         <form role="form" action="szamla.php" method="POST" autocomplete="off">
		 <body>	
                <div class="calculator-wrapper" id="calculator-wrapper">
					<div id="wide">Vevő adatai:<br>
						<input type="text" name="cim[]" placeholder="vevő neve" size="70" id="vevo_neve"  class="set-width440"/>
						<input type="text" name="cim[]" placeholder="orszag" size="30" value="Magyarország" id="vevo_orszag" class="set-width330"/>
						<input type="text" name="cim[]" placeholder="irszám" size="2" id="vevo_irszam" class="set-width50"/>
						<input type="text" name="cim[]" placeholder="település" size="30" id="vevo_varos" class="set-width200"/>
						<input type="text" name="cim[]" placeholder="közterület neve" size="25" id="vevo_utca" class="set-width200"/>
						<!--  regi beiros valtozat, java rész felül
						<input type="text" name="cim[]" placeholder="közter. jellege" size="8" id="vevo_utca_megnevezes" class="set-width100"/> 
						-->
						<select name="cim[]" id="vevo_utca_megnevezes"/>

						<input type="text" name="cim[]" placeholder="házszám" size="3"  id="vevo_utca_hazszam" class="set-width50"/>
						<input type="text" name="cim[]" placeholder="épület" size="2" id="vevo_epulet" class="set-width50"/>
						<input type="text" name="cim[]" placeholder="lépcsőház" size="2" id="vevo_lepcsohaz" class="set-width50"/>
						<input type="text" name="cim[]" placeholder="emelet" size="2" id="vevo_emelet" class="set-width50"/>
						<input type="text" name="cim[]" placeholder="ajtó" size="4" id="vevo_ajto" class="set-width50"/>
						<input type="text" name="cim[]" placeholder="adószám" size="15" id="vevo_adoszam" class="set-width300"/>
						<input type="text" name="cim[]" placeholder="EU adószám" size="15" id="vevo_eu_adoszam" class="set-width300"/>
						<input type="text" name="cim[]" placeholder="csasz" size="15" id="vevo_csasz" class="set-width300"/>
						<input type="text" name="cim[]" placeholder="bankszámlaszám" size="30" id="vevo_bankszamla" class="set-width350"/>
						<input type="text" name="cim[]" placeholder="email" size="30" id="vevo_email" class="set-width350"/>
						<!-- egyenlőre kikapcsolva
						<div align="right"><small>Számla küldése emailben:</small><input type="checkbox" name="szla_email" value="1"/></div>
					    -->
					</div>
					<div id="narrow">
						<label>Kiállítás Dátuma:</label>
						<input type="text" name="szamla_fejlec[]" value="<?php echo date('Y-m-d'); ?>" size="10" readonly class="set-width100readonly"/>
					<?
						$menu = $_GET['menu'];

			 //dijbekérőnél nem kel teljesítés dátuma
					if($menu=="ujszamla")
							{
							print("<label>Teljesítés dátuma:</label><br>");
							print("<input type='text' name='szamla_fejlec[]' placeholder='Teljesítés dátuma' size='10' id='datepicker' readonly='readonly' class='set-width100' />");
							}
							else
							{
							//azért kell, hogy a szamla_fejlec[ tömb ne csűsszön el
							print("<input type='hidden' name='szamla_fejlec[]' value='' placeholder='teljdatum' size='10' id='datepicker' class='set-width100' />");
							}
					?>

						<label>Fizetési határidő:</label><br>
						<input type="text" name="szamla_fejlec[]" placeholder="Fiz. határidő" size="10" id="datepicker2" readonly='readonly' class="set-width100" />
						<label>Fizetési mód: </label><br>
						<select name="szamla_fejlec[]" class="set-width"/>
							<option value="Készpénz">Készpénz</option>
							<option value="Átutalás">Átutalás</option>
							<option value="Paypal">Paypal</option>
							<option value="Paypal">Utánvétel</option>
							<option value="Paypal">Bankkártya</option>
							<option value="Paypal">Csekk</option>
							<option value="Paypal">SZÉP kártya</option>
						</select>
						<!--
						<label>Számlatömb: </label><br>
						<select name="szamla_fejlec[]" class="set-width" />
							<option value="HUF">HUF</option>
							<option value="EUR">EUR</option>
						</select>
						-->
						<input type="hidden" name="szamla_fejlec[]" value="HUF"/>

						<input type="hidden" name="bizonylat_tipus" value="<?php echo $menu; ?>"/>
						
						<input type="hidden" name="szamla_egysegar_tipus" id="szamla_egysegar_tipus" value="netto"/>

					</div>

				<table width=1100px  border=0>
				<tr><td colspan=9><hr></td></tr>
				<tr>
				<td width=310px> Megnevezés</td><td width=100px>Mennyiség</td><td width=40px>Mee</td><td width=120><div id="brutto_netto"><u><font color=#389fbd>Nettó egységár</font></u><img src=pic/change-icon.png width=16px></img></div></td><td width=100>Áfakulcs</td>
				<td width=110>Nettó érték</td><td width=100>Áfa érték</td><td width=80>Bruttó érték</td><td  width=100px></td>
				</tr>
				</table>
				</div>
                <button type="button" class="add-field" onClick="addCalculator()">+ tétel hozzáadása</button>

				<br><br>
				Megjegyzés: <br>
				<textarea style="text-align:left" rows="6" cols="120" name="szamla_megjegyzes" ></textarea>
					<div style="text-align:right"> 
						
						Nettó: <input type="text" name="szamla_sum[]" placeholder="Nettó összesen" size="15" id="total_netto" readonly /><br>
						ÁFA: <input type="text" name="szamla_sum[]" placeholder="Áfa összesen" size="15" id="total_afa" readonly /><br>
						Összesen fizetendő, bruttó: <input type="text" name="szamla_sum[]" placeholder="Fizetendő, bruttó" size="15" id="total_brutto" readonly /><br>

						<br><br>
						<?
						//gombbin lévő szöveg attól függően, hogy szamla vagy dijbekero
						if($menu=="ujszamla")
							{
							print("<input type='submit' id='save_invoice' value='Számla mentése'>");
							}
						if($menu=="ujdijbekero")
							{
							print("<input type='submit' id='save_invoice' value='Dijbekérő mentése'>");
							}
						?>
							</div>
        </form>

</body>
</html>
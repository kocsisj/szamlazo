<style>
input[type='radio'] {
    -webkit-appearance:none;
    width:20px;
    height:20px;
    border: 2px solid #004c97;
    border-radius:50%;
    outline:none;
    box-shadow:0 0 5px 0px gray inset;
}
input[type='radio']:hover {
    box-shadow:0 0 5px 0px orange inset;
}
input[type='radio']:before {
    content:'';
    display:block;
    width:60%;
    height:60%;
    margin: 20% auto;    
    border-radius:50%;    
}
input[type='radio']:checked:before {
    background:#004c97;
}
label { display: block;
		width: 400px;
 margin-left: auto;
    margin-right: auto;
}

</style>
<center>
<table height=250px>
<form name="form" method="post" action=""> 
<input type="hidden" name="elofizetes_aktivalasa" value="1" />
	<input type="hidden" name="username_reg" value="<? echo $username ?>" />
	<tr><td width=60px><br><br><input type="radio" id="bank" name="fizetesi_mod" value="bank" checked /></td><td width=400px><label for="bank"> Banki átutalással fizetek (e-mailben díjbekérőt küldünk, amely alapján teljesíthető az átutalás)</label></td></tr>
	<tr><td><br><br><input type="radio" name="fizetesi_mod" id="paypal" value="paypal" /></td><td width=400px><label for="paypal"> Paypal-al fizetek (átirányítjuk a paypal weboldalára, paypal account szükséges)</label></td></tr>
	<tr><td></td><td><br><input name="submit" type="submit" value="Tovább >>>" /></td></tr>
	</table>
</form>


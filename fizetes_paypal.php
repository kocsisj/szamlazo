<br><br><center>
<h3>A következő lépésben átirányítjuk a Paypal weboldalára ahol elvégezheti a fizetést.</h3><br/><br>

<!--

<form action="paypal.php" method="post" target="_top">
-->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="paypalrol az azoinosiato">
<input type="hidden" name="custom" value="<? echo $username ?>">
<!--
<input type="image" src="http://kszamla.hu/szamla/pic/fizetes.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
-->
<input type="submit" border="0" name="submit" value="Tovább a fizetéshez" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>






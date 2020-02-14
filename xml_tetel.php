<?
// tetelek
error_reporting( error_reporting() & ~E_NOTICE );

//$tetelek = $xml->createElement("tetelek");
		//$szamla->appendChild($tetelek);
		//$id=1;

	$tetel = $xml->createElement("termek_szolgaltatas_tetelek");
	$szamla->appendChild($tetel);
	//$tetel->setAttribute("id",$id);

		$termeknev = $xml->createElement("termeknev",$Q_termeknev);
		$tetel->appendChild($termeknev);

		$tetel_mennyiseg = $xml->createElement("menny",$Q_tetel_mennyiseg);
		$tetel->appendChild($tetel_mennyiseg);

		$tetel_mennyisegi_egyseg = $xml->createElement("mertekegys",$Q_tetel_mennyisegi_egyseg);
		$tetel->appendChild($tetel_mennyisegi_egyseg);

		$tetel_kozv_szolg = $xml->createElement("kozv_szolgaltatas",$Q_tetel_kozv_szolg);
		if ($Q_tetel_kozv_szolg=="true") $tetel->appendChild($tetel_kozv_szolg);

		$nettoar = $xml->createElement("nettoar",$Q_nettoar);
		$tetel->appendChild($nettoar);

		$tetel_netto_egysegar = $xml->createElement("nettoegysar",$Q_tetel_netto_egysegar);
		$tetel->appendChild($tetel_netto_egysegar);

		$afakulcs = $xml->createElement("adokulcs",$Q_afakulcs);
		$tetel->appendChild($afakulcs);

		$afaertek = $xml->createElement("adoertek",$Q_afaertek);
		$tetel->appendChild($afaertek);

		$bruttoar = $xml->createElement("bruttoar",$Q_bruttoar);
		$tetel->appendChild($bruttoar);

		//$engedmeny = $xml->createElement("engedmeny",$Q_engedmeny);
		//$tetel->appendChild($engedmeny);

		//$engedmenyszazalek = $xml->createElement("engedmenyszazalek",$Q_engedmenyszazalek);
		//$tetel->appendChild($engedmenyszazalek);


?>
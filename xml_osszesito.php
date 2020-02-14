<?
// osszesites
	$osszesites = $xml->createElement("osszesites");
	$szamla->appendChild($osszesites);

	//afarovat
	$id=1;
	for ($x = 0; $afa[$x] != "" ; $x++) {
	$afarovat = $xml->createElement("afarovat");
	$osszesites->appendChild($afarovat);
	//$afarovat->setAttribute("id",$id);

		$nettoar = $xml->createElement("nettoar",$afa_netto_ertek[$afa[$x]]);
		$afarovat->appendChild($nettoar);

		// ha null-ként jön az afa akkor 0-at irunk az xmlben
		if ($afa[$x] == "null"){
		$afakulcs = $xml->createElement("adokulcs","0");
		}
		else
		{
		$afakulcs = $xml->createElement("adokulcs",$afa[$x]);
		}
		$afarovat->appendChild($afakulcs);

		$afaertek = $xml->createElement("adoertek",$afa_ertek[$afa[$x]]);
		$afarovat->appendChild($afaertek);

		$bruttoar = $xml->createElement("bruttoar",$afa_brutto_ertek[$afa[$x]]);
		$afarovat->appendChild($bruttoar);
		$id++;
	} 
		
		
	//vegosszeg
	$vegosszeg = $xml->createElement("vegosszeg");
	$osszesites->appendChild($vegosszeg);
		$nettoarossz = $xml->createElement("nettoarossz",$Q_nettoarossz);
		$vegosszeg->appendChild($nettoarossz);

		$afaertekossz = $xml->createElement("afaertekossz",$Q_afaertekossz);
		$vegosszeg->appendChild($afaertekossz);

		$bruttoarossz = $xml->createElement("bruttoarossz",$Q_bruttoarossz);
		$vegosszeg->appendChild($bruttoarossz);

		// afa tartalom csak egyszerűsített számla esetén kell, ami most nem játszik
		//$afa_tartalom = $xml->createElement("afa_tartalom",$Q_afa_tartalom);
		//$vegosszeg->appendChild($afa_tartalom);

// afa osszesito adattatrtalmanak kiirasa



 ?>

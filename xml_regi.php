<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
    $xml = new DOMDocument('1.0', 'UTF-8');
 
    $szamla = $xml->createElement("szamla");
	$xml->appendChild($szamla);
	
// szamla fejlec	
	$fejlec = $xml->createElement("fejlec");
	$szamla->appendChild($fejlec);
	
	// eledo adatai
	$elado = $xml->createElement("elado");
	$fejlec->appendChild($elado);
	
	$nev = $xml->createElement("nev",$Q_nev_elado);
	$elado->appendChild($nev);
	$adoszam = $xml->createElement("adoszam",$Q_adoszam_elado);
	$elado->appendChild($adoszam);
	$csasz = $xml->createElement("csasz",$Q_csasz_elado);
	$elado->appendChild($csasz);
	//cim
	$cim = $xml->createElement("cim");
	$elado->appendChild($cim);
		$orszag = $xml->createElement("orszag",$Q_orszag_elado);
		$cim->appendChild($orszag);
		$telepules = $xml->createElement("telepules",$Q_telepules_elado);
		$cim->appendChild($telepules);
		$irszam = $xml->createElement("irszam",$Q_irszam_elado);
		$cim->appendChild($irszam);
		$korzetnev = $xml->createElement("korzetnev",$Q_korzetnev_elado);
		$cim->appendChild($korzetnev);
		$kozterjell = $xml->createElement("kozterjell",$Q_kozterjell_elado);
		$cim->appendChild($kozterjell);
		
		$hazszam = $xml->createElement("hazszam",$Q_hazszam_elado);
		$cim->appendChild($hazszam);
		$epulet = $xml->createElement("epulet",$Q_epulet_elado);
		$cim->appendChild($epulet);
		$emelet = $xml->createElement("emelet",$Q_emelet_elado);
		$cim->appendChild($emelet);
		$ajto = $xml->createElement("ajto",$Q_ajto_elado);
		$cim->appendChild($ajto);
		
	// vevő adatai
	$vevo = $xml->createElement("vevo");
	$fejlec->appendChild($vevo);
	
	$nev = $xml->createElement("nev",$Q_nev_vevo);
	$vevo->appendChild($nev);
	$adoszam = $xml->createElement("adoszam",$Q_adoszam_vevo);
	$vevo->appendChild($adoszam);
	$csasz = $xml->createElement("csasz",$Q_csasz_vevo);
	$vevo->appendChild($csasz);
	//cim
	$cim = $xml->createElement("cim");
	$vevo->appendChild($cim);
		$orszag = $xml->createElement("orszag",$Q_orszag_vevo);
		$cim->appendChild($orszag);
		$telepules = $xml->createElement("telepules",$Q_telepules_vevo);
		$cim->appendChild($telepules);
		$irszam = $xml->createElement("irszam",$Q_irszam_vevo);
		$cim->appendChild($irszam);
		$korzetnev = $xml->createElement("korzetnev",$Q_korzetnev_vevo);
		$cim->appendChild($korzetnev);
		$kozterjell = $xml->createElement("kozterjell",$Q_kozterjell_vevo);
		$cim->appendChild($kozterjell);
		
		$hazszam = $xml->createElement("hazszam",$Q_hazszam_vevo);
		$cim->appendChild($hazszam);
		$epulet = $xml->createElement("epulet",$Q_epulet_vevo);
		$cim->appendChild($epulet);
		$emelet = $xml->createElement("emelet",$Q_emelet_vevo);
		$cim->appendChild($emelet);
		$ajto = $xml->createElement("ajto",$Q_ajto_vevo);
		$cim->appendChild($ajto);

	// szamlainfo
	$szamlainfo = $xml->createElement("szamlainfo");
	$fejlec->appendChild($szamlainfo);
		$sorszam = $xml->createElement("sorszam",$Q_sorszam);
		$szamlainfo->appendChild($sorszam);

		$kialldatum = $xml->createElement("kialldatum",$Q_kialldatum);
		$szamlainfo->appendChild($kialldatum);

		$teljdatum = $xml->createElement("teljdatum",$Q_teljdatum);
		$szamlainfo->appendChild($teljdatum);

		$fizhatarido = $xml->createElement("fizhatarido",$Q_fizhatarido);
		$szamlainfo->appendChild($fizhatarido);

		$fizmod = $xml->createElement("fizmod",$Q_fizmod);
		$szamlainfo->appendChild($fizmod);

		$szamlatipusa = $xml->createElement("szamlatipusa",$Q_szamlatipusa);
		$szamlainfo->appendChild($szamlatipusa);

		$hivatkozottszamla = $xml->createElement("hivatkozottszamla",$Q_hivatkozottszamla);
		$szamlainfo->appendChild($hivatkozottszamla);

		$egyebadat = $xml->createElement("egyebadat",$Q_egyebadat);
		$szamlainfo->appendChild($egyebadat);

		$penznem = $xml->createElement("penznem",$Q_penznem);
		$szamlainfo->appendChild($penznem);


	
// tetelek
	$tetelek = $xml->createElement("tetelek");
	$szamla->appendChild($tetelek);

	$tetel = $xml->createElement("tetel");
	$tetelek->appendChild($tetel);
	$tetel->setAttribute("id",1);
		$termeknev = $xml->createElement("termeknev",$Q_termeknev);
		$tetel->appendChild($termeknev);

		$besorszam = $xml->createElement("besorszam",$Q_besorszam);
		$tetel->appendChild($besorszam);

		$nettoar = $xml->createElement("nettoar",$Q_nettoar);
		$tetel->appendChild($nettoar);
		
		$afakulcs = $xml->createElement("afakulcs",$Q_afakulcs);
		$tetel->appendChild($afakulcs);
		
		$afaertek = $xml->createElement("afaertek",$Q_afaertek);
		$tetel->appendChild($afaertek);
		
		$bruttoar = $xml->createElement("bruttoar",$Q_bruttoar);
		$tetel->appendChild($bruttoar);
		
		$engedmeny = $xml->createElement("engedmeny",$Q_engedmeny);
		$tetel->appendChild($engedmeny);
		
		$engedmenyszazalek = $xml->createElement("engedmenyszazalek",$Q_engedmenyszazalek);
		$tetel->appendChild($engedmenyszazalek);
	
// osszesites
	$osszesites = $xml->createElement("osszesites");
	$szamla->appendChild($osszesites);

	//afarovat
	$afarovat = $xml->createElement("afarovat");
	$osszesites->appendChild($afarovat);
	$afarovat->setAttribute("id",1);
		$afakulcs = $xml->createElement("afakulcs",$Q_afakulcs);
		$afarovat->appendChild($afakulcs);

		$nettoar = $xml->createElement("nettoar",$Q_);
		$afarovat->appendChild($nettoar);

		$afaertek = $xml->createElement("afaertek",$Q_nettoar);
		$afarovat->appendChild($afaertek);

		$bruttoar = $xml->createElement("bruttoar",$Q_bruttoar);
		$afarovat->appendChild($bruttoar);

	//vegosszeg
	$vegosszeg = $xml->createElement("vegosszeg");
	$osszesites->appendChild($vegosszeg);
		$nettoarossz = $xml->createElement("nettoarossz",$Q_nettoarossz);
		$vegosszeg->appendChild($nettoarossz);

		$afaertekossz = $xml->createElement("afaertekossz",$Q_afaertekossz);
		$vegosszeg->appendChild($afaertekossz);

		$bruttoarossz = $xml->createElement("bruttoarossz",$Q_bruttoarossz);
		$vegosszeg->appendChild($bruttoarossz);
	
	 $xml->FormatOutput =true;
	 $string_value = $xml->saveXML();
	  $xml->save("eeee.xml")
	
	
 ?>



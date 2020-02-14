<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);


// szamla fejlec	
	//$fejlec = $xml->createElement("fejlec");
	//$szamla->appendChild($fejlec);

// fejlec
	$fejlec = $xml->createElement("fejlec");
	$szamla->appendChild($fejlec);
		$sorszam = $xml->createElement("szlasorszam",$Q_sorszam);
		$fejlec->appendChild($sorszam);

		$szamlatipusa = $xml->createElement("szlatipus",$Q_szamlatipusa);
		$fejlec->appendChild($szamlatipusa);

		$kialldatum = $xml->createElement("szladatum",$Q_kialldatum);
		$fejlec->appendChild($kialldatum);

		$teljdatum = $xml->createElement("teljdatum",$Q_teljdatum);
		$fejlec->appendChild($teljdatum);

		//$fizhatarido = $xml->createElement("fizhatarido",$Q_fizhatarido);
		//$fejlec->appendChild($fizhatarido);

		//$fizmod = $xml->createElement("fizmod",$Q_fizmod);
		//$fejlec->appendChild($fizmod);

		//$hivatkozottszamla = $xml->createElement("hivatkozottszamla",$Q_hivatkozottszamla);
		//$fejlec->appendChild($hivatkozottszamla);

		//$egyebadat = $xml->createElement("egyebadat",$Q_egyebadat);
		//$fejlec->appendChild($egyebadat);

		//$penznem = $xml->createElement("penznem",$Q_penznem);
		//$fejlec->appendChild($penznem);

	// szamlakibocsato adatai
	$elado = $xml->createElement("szamlakibocsato");
	$szamla->appendChild($elado);

	$adoszam = $xml->createElement("adoszam",$Q_adoszam_elado);
	if ($Q_adoszam_elado!="") $elado->appendChild($adoszam);

	$kozadoszam = $xml->createElement("kozadoszam",$Q_adoszam_eu_elado);
	if ($Q_adoszam_eu_elado!="") $elado->appendChild($kozadoszam);

	$kisadozo = $xml->createElement("kisadozo",$Q_kisadozo_elado);
	if ($Q_kisadozo_elado!="") $elado->appendChild($kisadozo);

	$nev = $xml->createElement("nev",$Q_nev_elado);
	$elado->appendChild($nev);

	//$csasz = $xml->createElement("csasz",$Q_csasz_elado);
	//$elado->appendChild($csasz);

	//cim
	$cim = $xml->createElement("cim");
	$elado->appendChild($cim);
		//$orszag = $xml->createElement("orszag",$Q_orszag_elado);
		//$cim->appendChild($orszag);
		$irszam = $xml->createElement("iranyitoszam",$Q_irszam_elado);
		$cim->appendChild($irszam);
		$telepules = $xml->createElement("telepules",$Q_telepules_elado);
		$cim->appendChild($telepules);
		$korzetnev = $xml->createElement("kozterulet_neve",$Q_korzetnev_elado);
		$cim->appendChild($korzetnev);
		$kozterjell = $xml->createElement("kozterulet_jellege",$Q_kozterjell_elado);
		$cim->appendChild($kozterjell);

		// kell az if mert ha üres akkor ne irjuk bele a szamlaba az elemet mert a séma validator hibát dob az üres mezőkre
		$hazszam = $xml->createElement("hazszam",$Q_hazszam_elado);
		if ($Q_hazszam_elado!="") $cim->appendChild($hazszam);

		$epulet = $xml->createElement("epulet",$Q_epulet_elado);
		if ($Q_epulet_elado!="") $cim->appendChild($epulet);

		$lepcsohaz = $xml->createElement("lepcsohaz",$Q_lepcsohaz_elado);
		if ($Q_lepcsohaz_elado!="") $cim->appendChild($lepcsohaz);

		$emelet = $xml->createElement("szint",$Q_emelet_elado);
		if ($Q_emelet_elado!="") $cim->appendChild($emelet);

		$ajto = $xml->createElement("ajto",$Q_ajto_elado);
		if ($Q_ajto_elado!="") $cim->appendChild($ajto);

	// vevő adatai
	$vevo = $xml->createElement("vevo");
	$szamla->appendChild($vevo);

	$adoszam = $xml->createElement("adoszam",$Q_adoszam_vevo);
	if ($Q_adoszam_vevo!="") $vevo->appendChild($adoszam);

	$kozadoszam = $xml->createElement("kozadoszam",$Q_adoszam_eu_vevo);
	if ($Q_adoszam_eu_vevo!="") $vevo->appendChild($kozadoszam);

	$nev = $xml->createElement("nev",$Q_nev_vevo);
	$vevo->appendChild($nev);
	//$csasz = $xml->createElement("csasz",$Q_csasz_vevo);
	//$vevo->appendChild($csasz);

	//cim
	$cim = $xml->createElement("cim");
	$vevo->appendChild($cim);
		//$orszag = $xml->createElement("orszag",$Q_orszag_vevo);
		//$cim->appendChild($orszag);
		$irszam = $xml->createElement("iranyitoszam",$Q_irszam_vevo);
		$cim->appendChild($irszam);
		$telepules = $xml->createElement("telepules",$Q_telepules_vevo);
		$cim->appendChild($telepules);
		$korzetnev = $xml->createElement("kozterulet_neve",$Q_korzetnev_vevo);
		$cim->appendChild($korzetnev);
		$kozterjell = $xml->createElement("kozterulet_jellege",$Q_kozterjell_vevo);
		$cim->appendChild($kozterjell);
		
		$hazszam = $xml->createElement("hazszam",$Q_hazszam_vevo);
		$cim->appendChild($hazszam);

		$epulet = $xml->createElement("epulet",$Q_epulet_vevo);
		if ($Q_epulet_vevo!="") $cim->appendChild($epulet);

		$lepcsohaz = $xml->createElement("lepcsohaz",$Q_lepcsohaz_vevo);
		if ($Q_lepcsohaz_vevo!="") $cim->appendChild($lepcsohaz);

		$emelet = $xml->createElement("szint",$Q_emelet_vevo);
		if ($Q_emelet_vevo!="")$cim->appendChild($emelet);

		$ajto = $xml->createElement("ajto",$Q_ajto_vevo);
		if ($Q_ajto_vevo!="") $cim->appendChild($ajto);






 ?>



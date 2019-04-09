<?php
	include("konekcija.inc");
	include("funkcije.inc");

	$idAdresa = $_POST['idAdresa'];
	$idKorisnik = $_POST['idKorisnik'];

	if (isset($idAdresa) && isset($idKorisnik)) {
		$upit = "delete from korisnik_adresa where id_adresa = $idAdresa and id_korisnik = $idKorisnik;";

		$rez = mysql_query($upit,$kon) or die("Error upit!".mysql_error());
	}
?>
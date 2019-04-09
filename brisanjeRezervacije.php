<?php
	include("konekcija.inc");
	include("funkcije.inc");

	$idRezervacija = $_POST['idRezervacija'];

	if (isset($idRezervacija)) {
		$upit = "delete from rezervacija where id_rezervacija = $idRezervacija;";

		$rez = mysql_query($upit,$kon) or die("Error upit!".mysql_error());
	}
?>
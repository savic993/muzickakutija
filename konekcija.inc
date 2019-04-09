<?php
	$greske = array();
	$host = "localhost";
	$korisnik = "root";
	$lozinka = "";
	@$kon = mysql_connect($host,$korisnik,$lozinka);
	$ime_baze = "kutija";
	@$baza = mysql_select_db($ime_baze,$kon);

	if (!$kon) {
		$greske[] = "Zao nam je. Problem sa serverom baze podataka!";
	}
	if (!$baza) {
		$greske[] = "Zao nam je. Problem sa bazom podataka!";
	}
?>
<?php
	include("konekcija.inc");

	$username = $_POST['username'];
	$imePrezime = $_POST['imePrezime'];
	
	$pUser = "";
	$pImePrez = "";
	$br = 0;

	if ($username != "") {
		if ($br == 0) {
			$pUser.=" username='$username'";
			$br++;
		}
		else{
			$pUser.=" and username='$username'";
		}
	}
	if ($imePrezime != "") {
		if ($br == 0) {
			$pImePrez.=" imePrezime='$imePrezime'";
			$br++;
		}
		else{
			$pImePrez.=" and imePrezime='$imePrezime'";
		}
	}

	$pSve = $pUser.$pImePrez;

	if ($pSve != "") {
		$upitPretraga = "select * from korisnik k inner join korisnik_adresa ka on k.id_korisnik=ka.id_korisnik inner join adresa a on ka.id_adresa=a.id_adresa where".$pSve;
	}
	else{
		$upitPretraga = "select * from korisnik k inner join korisnik_adresa ka on k.id_korisnik=ka.id_korisnik inner join adresa a on ka.id_adresa=a.id_adresa;";
	}

	$rezPretraga = mysql_query($upitPretraga,$kon) or die("Error upit");

	echo "<table>
			<tr>
				<td>Username</td>
				<td>Ime i prezime</td>
				<td>Adresa</td>
				<td>Email</td>
			</tr>";

	while ($redPretraga = mysql_fetch_array($rezPretraga)) {
		echo "<tr><td>".$redPretraga['username']."</td><td>".$redPretraga['imePrezime']."</td><td>".$redPretraga['grad']." ".$redPretraga['ulicaBroj']."</td><td>".$redPretraga['email']."</td><tr>";
	}

	echo "</table>";
?>
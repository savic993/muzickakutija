<?php
	include("konekcija.inc");

	$username = $_POST['username'];
	$naslov = $_POST['naslov'];

	$pUser = "";
	$pNaslov = "";
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
	if ($naslov != "") {
		if ($br == 0) {
			$pNaslov.=" naslov='$naslov'";
			$br++;
		}
		else{
			$pNaslov.=" and naslov='$naslov'";
		}
	}

	$pSve = $pUser.$pNaslov;

	if ($pSve != "") {
		$upitPretraga = "select * from korisnik k inner join rezervacija r on k.id_korisnik=r.id_korisnik inner join dogadjaj d on d.id_dogadjaj=r.id_dogadjaj where".$pSve;
	}
	else{
		$upitPretraga = "select * from korisnik k inner join rezervacija r on k.id_korisnik=r.id_korisnik inner join dogadjaj d on d.id_dogadjaj=r.id_dogadjaj;";
	}

	$rezPretraga = mysql_query($upitPretraga,$kon) or die("Error upit");

	echo "<table>
			<tr>
				<td>Username</td>
				<td>Naziv događaja</td>
				<td>Količina</td>
			</tr>";

	while ($redPretraga = mysql_fetch_array($rezPretraga)) {
		echo "<tr><td>".$redPretraga['username']."</td><td>".$redPretraga['naslov']."</td><td>".$redPretraga['kolicina']."</td><tr>";
	}

	echo "</table>";
?>
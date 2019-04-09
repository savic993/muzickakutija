<div id="forma">
	<h3>Pretraga korisnika</h3>
	<hr/>
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" name="adminPretragaKorisnika">
		<table>
			<tr>
				<td><label>Username</label></td>
				<td><input type="text" name="tbUsername" id="tbUsername" /></td>
				<td><label>Ime i prezime</label></td>
				<td><input type="text" name="tbImePrezime" id="tbImePrezime" /></td>
				<td><input type="button" name="btnPretragaKorisnici" id="btnPretragaKorisnici" value="Pretraga" /></td>
			</tr>
		</table>
	</form>
</div>
<div id="filter">
	<table>
		<tr>
			<td>Username</td>
			<td>Ime i prezime</td>
			<td>Adresa</td>
			<td>Email</td>
		</tr>
		<?php
			$upitPretraga = "select * from korisnik k inner join korisnik_adresa ka on k.id_korisnik=ka.id_korisnik inner join adresa a on ka.id_adresa=a.id_adresa;";

			$rezPretraga = mysql_query($upitPretraga,$kon);

			while ($redPretraga = mysql_fetch_array($rezPretraga)) {
				echo "<tr><td>".$redPretraga['username']."</td><td>".$redPretraga['imePrezime']."</td><td>".$redPretraga['grad']." ".$redPretraga['ulicaBroj']."</td><td>".$redPretraga['email']."</td></tr>";
			}
		?>
	</table>
</div>
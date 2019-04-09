<div id="forma">
	<h3>Pretraga rezervacija</h3>
	<hr/>
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" name="adminPretragaRezervacija">
		<table>
			<tr>
				<td><label>Username</label></td>
				<td><input type="text" name="tbUsername" id="tbUsername" /></td>
				<td><label>Naziv događaja</label></td>
				<td><input type="text" name="tbNazivDogadjaja" id="tbNazivDogadjaja" /></td>
				<td><input type="button" name="btnPretragaRezervacija" id="btnPretragaRezervacija" value="Pretraga" /></td>
			</tr>
		</table>
	</form>
</div>
<div id="filter">
	<table>
		<tr>
			<td>Username</td>
			<td>Naziv događaja</td>
			<td>Količina</td>
		</tr>
		<?php
			$upitPretraga = "select * from korisnik k inner join rezervacija r on k.id_korisnik=r.id_korisnik inner join dogadjaj d on d.id_dogadjaj=r.id_dogadjaj;";

			$rezPretraga = mysql_query($upitPretraga,$kon);

			while ($redPretraga = mysql_fetch_array($rezPretraga)) {
				echo "<tr><td>".$redPretraga['username']."</td><td>".$redPretraga['naslov']."</td><td>".$redPretraga['kolicina']."</td></tr>";
			}
		?>
	</table>
</div>
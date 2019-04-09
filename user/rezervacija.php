<?php
	if (isset($_POST['btnOK'])) {
		$koncert = $_POST['ddlDogadjaj'];
		$kolicina = $_POST['tbKolicina'];
		@$potvrda = $_POST['chbPotvrda'];
		$idKor = $_SESSION['id_korisnik'];

		$regKolicina = "/$[1-4]^/";

		if ($koncert == 0) {
			echo "<div id='error'>Izaberite događaj</div>";
		}
		else if ($potvrda <> 1) {
			echo "<div id='error'>Potvrdite tacnost podataka</div>";
		}
		else if (preg_match($regKolicina, $kolicina) || ($kolicina < 1) || ($kolicina > 4) ) {
			echo "<div id='error'>Maksimalno mozete naruciti 4, a najmanje 1 kartu</div>";
		}
		else
		{
			$upitUpis = "insert into rezervacija values('',$koncert,$idKor,$kolicina);";
			$rezUpis = mysql_query($upitUpis,$kon);
			if ($rezUpis) {
				echo "<div id='poruka'>Uspešno ste naručili kartu</div>";
			}
			else
			{
				echo "<div id='error'>Rezervacija nije uspešno uneta</div>";
			}
		}
	}
?>
<h3>Rezervisite ulaznicu</h3>
<h5>Napomena: Maksimalno mozete naručiti 4 karte po događaju.</h5>
<div id="rezervacija">
<?php
	$adresa = "";
	$podaci = "";
	$id_user = $_SESSION['id_korisnik'];
	$upitUser = "select * from korisnik k inner join korisnik_adresa ka on k.id_korisnik=ka.id_korisnik inner join adresa a on a.id_adresa=ka.id_adresa where k.id_korisnik = $id_user;";

	$rezUpitUser = mysql_query($upitUser,$kon);
	if (mysql_num_rows($rezUpitUser) == 1) 
	{
		$redAdresa = mysql_fetch_array($rezUpitUser);
		$podaci .= "Ime i prezime: <b>".$redAdresa['imePrezime']."</b></br>";
		$podaci .= "Adresa: <b>".$redAdresa['ulicaBroj']." ".$redAdresa['grad']."</b>";
		
		echo "<fieldset><legend>Kupac</legend>".$podaci."</fieldset>";
	}
	else
	{
		$upitLink = "select * from meni where naziv='Moj profil';";
		$rezLink = mysql_query($upitLink,$kon);
		$redLink = mysql_fetch_array($rezLink);
		echo "<div class='alert'>Izaberite adresu na koju zelite da Vam pošaljemo ulaznice na stranici <a href='".$redLink['link']."'>".$redLink['naziv']."</a></div>";;
	}
?>
	<form action="<?php $_SERVER["PHP_SELF"] ?>" name="formaRezervacija" method="POST">
		<fieldset>
			<legend>Ulaznice</legend>
			<table>
				<tr>
					<td>Događaj:</td>
					<td>
						<select id="dllDogadjaj" name="ddlDogadjaj">
							<option value="0">Izaberite</option>
							<?php
								$op = prikazPost("dogadjaj",$kon);
								foreach ($op as $o)
								{
									$time = $o['vreme'];
									if (time() < $time) {
										echo "<option value='".$o['id_dogadjaj']."'>".$o['naslov']."</option>";
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Količina:</td>
					<td><input type="text" name="tbKolicina"/></td>
				</tr>
				<tr>
					<td>Potvrđujem tačnost podataka:</td>
					<td><input type="checkbox" name="chbPotvrda" value="1"/></td>
				</tr>
				<tr>
					<td><input type="submit" name="btnOK" value="Naruci"/></td>
				</tr>
			</table>
		</fieldset>
	</form>
</div>
<div id="mojeNarudzbine">
	<?php
		$id_user = $_SESSION['id_korisnik'];

		$upitNarudzbine = "select * from korisnik k inner join rezervacija r on k.id_korisnik = r.id_korisnik inner join dogadjaj d on r.id_dogadjaj = d.id_dogadjaj where r.id_korisnik = $id_user;";
		$rezNarudzbine = mysql_query($upitNarudzbine,$kon);
		if (mysql_num_rows($rezNarudzbine) <> 0) {
			?>
				<table>
					<tr>
						<td>Dogadjaj</td>
						<td>Kolicina</td>
						<td>Brisanje</td>
					</tr>
					<?php
						while ($redNarudzbine = mysql_fetch_array($rezNarudzbine)) {
							echo "<tr><td>".$redNarudzbine['naslov']."</td><td>".$redNarudzbine['kolicina']."</td><td><img src='slike/ikonice/drop.png' alt='drop' _idRez='".$redNarudzbine["id_rezervacija"]."' class='delete' /></td></tr>";
						}
					?>
				</table>
			<?php
		}
		else
		{
			echo "<div id='error'>Trenutno nemate narudzbina</div>";
		}
	?>
</div>
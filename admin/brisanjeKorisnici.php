<?php
	if (isset($_POST['btnIzbrisi'])) {
		$id_kor = $_POST['izbrisi'];

		foreach ($id_kor as $id) {
			$upitBrisanje = "delete from korisnik where id_korisnik =".$id.";";
			$rezBrisanje = mysql_query($upitBrisanje,$kon);
		}
		if ($rezBrisanje) {
			echo "<div id='success'>Uspešno ste obrisali korisnike</div>";
		}
		else
		{
			echo "<div id='error'>Greška pri brisanju</div>";
		}
	}
?>
<div class="prikaz">
	<h3>Brisanje korisnika</h3>
	<hr/>
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" name="adminBrisanjeKorisnika">
		<table>
			<tr>
				<td>Korisničko ime</td>
				<td>Email</td>
				<td>Ime i prezime</td>
				<td>Uloga</td>
				<td>Izbriši</td>
			</tr>
			<?php
				$kor = prikazAdminTabele("korisnik",$kon);
				foreach ($kor as $k) {
					$uloga = "";
					if ($k['id_uloga'] == 1) {
						$uloga = "Administrator";
					}
					else
					{
						$uloga = "Korisnik";
					}
					echo "<tr><td>".$k['username']."</td><td>".$k['email']."</td><td>".$k['imePrezime']."</td><td>".$uloga."</td><td><input type='checkbox' name='izbrisi[]' value='".$k['id_korisnik']."'/></td></tr>";
				}
			?>
			<tr>
				<td colspan="2">
					<input type="submit" name="btnIzbrisi" value="Izbriši" />
					<input type="reset" name="btnRestart" value="Poništi" />
				</td>
			</tr>
		</table>
	</form>
</div>
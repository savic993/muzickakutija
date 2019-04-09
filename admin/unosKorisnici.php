<?php
	if (isset($_POST['btnIzmeni'])) {
		$uloga = $_POST['ddlUlogaIzmena'];
		$idKorisnik = $_POST['hIdKorisnika'];

		if ($uloga != 0) {
			$upitIzmena = "update korisnik set id_uloga=$uloga where id_korisnik=$idKorisnik;";
			$rezKorIzmena = mysql_query($upitIzmena,$kon);
			if ($rezKorIzmena) {
			 	echo "<div id='success'>Uspešno ste promenili ulogu korisniku</div>";
			}
			else
			{
				echo "<div id='error'>Uloga nije promenjena</div>";
			} 
		}
		else
		{
			echo "<div id='error'>Izaberite ulogu korisnika</div>";
		}
	}
	else if (isset($_POST['btnUnesi'])) {
		$username = $_POST['tbKorIme'];
		$imePrezime = $_POST['tbImePrez'];
		$email = $_POST['tbEmail'];
		$password = $_POST['tbLozinka'];
		$uloga = $_POST['ddlUloga'];

		$regUsername = "/^[A-z]{2,20}$/";
		$regImePrez = "/^[A-Z][a-z]{2,10}\s[A-Z][a-z]{4,10}$/";
		$regEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";

		$username = zastita($username);
		$imePrezime = zastita($imePrezime);
		$email = zastita($email);
		$password = md5($password);

		if (!preg_match($regUsername, $username) || strlen($username) < 1 && strlen($username) > 25) {
			echo "<div id='error'>Korisničko ime nije u dobrom formatu</div>";
		}
		else if (!preg_match($regImePrez, $imePrezime) || strlen($imePrezime) < 1 && strlen($imePrezime) > 50 ) {
			echo "<div id='eroor'>Ime i prezime nije u dobrom formatu</div>";
		}
		else if (!preg_match($regEmail, $email) || strlen($email) < 1 && strlen($email) > 50) {
			echo "<div id='error'>Email nije u dobrom formatu</div>";
		}
		else if (strlen($password) < 1 && strlen($password) > 50) {
			echo "<div id='error'>Lozinka nije u dobrom formatu</div>";
		}
		else if ($uloga == 0) {
			echo "<div id='error'>Niste izabrali ulogu</div>";
		}
		else
		{
			$upitUnosKorisnika = "insert into korisnik values('','$username','$imePrezime','$email','$password',$uloga);";
			$rezUpisKor = mysql_query($upitUnosKorisnika, $kon);
			if ($rezUpisKor) {
				echo "<div id='success'>Uspešno ste uneli korisnika</div>";
			}
			else
			{
				echo "<div id='error'>Korisnik nije unet</div>";
			}
		}
	}
?>
<div class="forma">
	<h3>Unos korisnika</h3>
	<hr/>
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" name="adminFormaKorisnika">
		<table>
			<tr>
				<td>Korisničko ime</td>
				<td><input type="text" name="tbKorIme"/>
					<input type="hidden" name="idKor" value="" id="idKor" /></td>
			</tr>
			<tr>
				<td>Ime i prezime</td>
				<td><input type="text" name="tbImePrez"/></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" name="tbEmail"/></td>
			</tr>
			<tr>
				<td>Lozinka</td>
				<td><input type="password" name="tbLozinka"/></td>
			</tr>
			<tr>
				<td>Uloga</td>
				<td>
					<select name="ddlUloga">
						<option value="0">Izaberi</option>
						<?php
							ddl("uloga",$kon,"id_uloga","naziv");
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="btnUnesi" value="Unesi" />
					<input type="reset" name="btnRestart" value="Poništi" />
				</td>
			</tr>
		</table>
	</form>
</div>
<div class="prikaz">
	<h3>Korisnici</h3>
	<hr/>
	<form action="" method="POST" name="adminIzmenaKorisnika">
		<table>
			<tr>
				<td>Korisničko ime</td>
				<td>Email</td>
				<td>Ime i prezime</td>
				<td>Uloga</td>
				<td>Izmeni</td>
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
					echo "<tr><td>".$k['username']."</td><td>".$k['email']."</td><td>".$k['imePrezime']."</td><td>".$uloga."</td><td><img src='slike/ikonice/edit.png' alt='izmeni' class='edit' _idKor='".$k['id_korisnik']."' /></td></tr>";
				}
			?>
		</table>
	</form>
</div>
<div id="izmena">
</div>
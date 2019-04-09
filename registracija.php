<?php
	if (isset($_POST['btnRegistracija'])) {
		$korIme = $_POST['tbUsername'];
		$email = $_POST['tbEmail'];
		$l = $_POST['tbPassword'];
		$lp = $_POST['tbPasswordAgain'];
		$imePrez = $_POST['tbImePrezime'];

		$regKorIme = "/^[A-z]{2,20}([0-9])*$/";
		$regImePrez = "/^[A-Z][a-z]{2,10}\s[A-Z][a-z]{4,10}$/";
		$regEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
		$lozinka = md5($l);
		$lozPonovo = md5($lp);

		if (!preg_match($regKorIme, $korIme) || strlen($korIme) < 1 && strlen($korIme) > 25) {
			echo "<div id='error'>Korisničko ime nije u dobrom formatu</div>";
		}
		else if (!preg_match($regEmail, $email) || strlen($email) < 1 && strlen($email) > 50) {
			echo "<div id='error'>Email nije u dobrom formatu</div>";
		}
		else if (strlen($lozinka) < 1 && strlen($lozinka) > 50) {
			echo "<div id='error'>Lozinka nije u dobrom formatu</div>";
		}
		else if (strlen($lozPonovo) < 1 && strlen($lozPonovo) > 50) {
			echo "<div id='error'>Lozinke se ne poklapaju</div>";
		}
		else if (!preg_match($regImePrez, $imePrez) || strlen($imePrez) < 1 && strlen($imePrez) > 50 ) {
			echo "<div id='error'>Ime i prezime nije u dobrom formatu</div>";
		}
		else
		{
			$upitReg = "insert into korisnik values('','$korIme','$imePrez','$email','$lozinka',2);";
			$rezReg = mysql_query($upitReg, $kon);
			if ($rezReg) {
				echo "<div id='poruka'>Uspešno ste se registrovali</div>";
			}
			else
			{
				echo "<div id='error'>Greska pri registraciji</div>";
			}
		}
	}
?>
<div id="regForma">
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" onsubmit="return registracija();" name="fRegistracija">
		<table>
			<tr>
				<td>Korisničko ime</td>
				<td><input type="text" name="tbUsername" id="tbUsername" /></td>
			</tr>
			<tr>
				<td>Ime i prezime</td>
				<td><input type="text" name="tbImePrezime" id="tbImePrezime" /></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" name="tbEmail" id="tbEmail" /></td>
			</tr>
			<tr>
				<td>Lozinka</td>
				<td><input type="password" name="tbPassword" id="tbPassword" /></td>
			</tr>
			<tr>
				<td>Potvrdite lozinku</td>
				<td><input type="password" name="tbPasswordAgain" id="tbPasswordAgain" /></td>
			</tr>
			<tr>
				<td colspan="2" class="dugme"><input type="submit" name="btnRegistracija" value="Potvrdi" /></td>
			</tr>
		</table>
	</form>
</div>
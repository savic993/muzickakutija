<?php
	
	if (isset($_POST['btnUnesi'])) {
		$grad = $_POST['tbGrad'];
		$ulBr = $_POST['tbUlicaBroj'];

		$regGrad = "/^[A-Z][a-z]{2,19}(\s[A-Z][a-z]{2,9})?$/";

		if (preg_match($regGrad, $grad)) {
				$upitUnosAdrese = "insert into adresa values('','$grad','$ulBr');";
				$rezUpisAdrese = mysql_query($upitUnosAdrese,$kon);
				if ($rezUpisAdrese) {
						
					$adr = mysql_insert_id();
					$kor = $_SESSION['id_korisnik'];

					$upitUpisVezne = "insert into korisnik_adresa values('',$kor,$adr);";
					$rezUpisVezne = mysql_query($upitUpisVezne,$kon);

					if ($rezUpisVezne) {
						echo "<div id='poruka'>Uspešno ste upisali adresu</div>";
					}
					else
					{
						echo "<div id='error'>Upis adrese nije uspeo</div>";
					}
				}
			}
			else
			{
				echo "<div id='error'>Ime grada nije u dobrom formatu</div>";
			}
		}
	$id_user = $_SESSION['id_korisnik'];
	$upitUser = "select * from korisnik k inner join korisnik_adresa ka on k.id_korisnik=ka.id_korisnik inner join adresa a on a.id_adresa=ka.id_adresa where k.id_korisnik = $id_user;";

	$rezUpitUser = mysql_query($upitUser,$kon);

	if (mysql_num_rows($rezUpitUser) == 0) {
		?>
			<div class="forma">
				<h3>Unesite adresu</h3>
				<form method="POST" action="<?php $_SERVER["PHP_SELF"] ?>" name="formaAdresa">
					<table>
						<tr>
							<td>Grad:</td>
							<td><input type="text" name="tbGrad"/></td>
						</tr>
						<tr>
							<td>Ulica i broj:</td>
							<td><input type="text" name="tbUlicaBroj"/></td>
						</tr>
						<tr>
							<td><input type="submit" name="btnUnesi" value="Potvrdi"/></td>
						</tr>
					</table>
				</form>
			</div>
		<?php
	}
	else if (mysql_num_rows($rezUpitUser) == 1) {
?>
<div id="podaci">
	<h3>Lični podaci</h3>
	<?php
		$redUser = mysql_fetch_array($rezUpitUser);
		echo "Ime i prezime: <b>".$redUser['imePrezime']."</b><br/>
			Username: <b>".$redUser['username']."</b><br/>
			Email: <b>".$redUser['email']."</b><br/>";
	?>
</div>
<div id="adresa">
	<h3>Adresa</h3>
	<?php
		echo "<b><i>".$redUser['ulicaBroj']." ".$redUser['grad']."</i></b><img src='slike/ikonice/drop.png' alt='drop' _idAdr='".$redUser["id_adresa"]."' _idKor='".$redUser["id_korisnik"]."' class='deleteAdresa' /><br/>";
	?>
</div>
<?php
}
else
{
?>
<div id="podaci">
	<h3>Lični podaci</h3>
	<?php
		$red = mysql_fetch_array($rezUpitUser);
		echo "Ime i prezime: <b>".$red['imePrezime']."</b><br/>
			Username: <b>".$red['username']."</b><br/>
			Email: <b>".$red['email']."</b><br/>";
	?>
</div>
<div id="adresa">
	<h3>Adrese</h3>
	<h5>Izaberite trenutno mesto na koje želite dostavu</h5>
<?php
	$upitAdresa = "select * from korisnik k inner join korisnik_adresa ka on k.id_korisnik=ka.id_korisnik inner join adresa a on a.id_adresa=ka.id_adresa where k.id_korisnik = $id_user;";

	$rezUpitAdresa = mysql_query($upitAdresa,$kon);
	while ($redAdresa = mysql_fetch_array($rezUpitAdresa)) {
		echo "<b><i>".$redAdresa['ulicaBroj']." ".$redAdresa['grad']."</i></b><img src='slike/ikonice/drop.png' alt='drop' _idAdr='".$redAdresa["id_adresa"]."' _idKor='".$redAdresa["id_korisnik"]."' class='deleteAdresa' /><br/>";
	}
?>
</div>
<?php
}
?>
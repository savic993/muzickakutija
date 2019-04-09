<?php
	if (isset($_POST['btnUnesi']))
	{
		$user = $_POST['ddlUser'];
		$dogadjaj = $_POST['ddlDogadjaj'];
		@$kolicina = $_POST['rbKolicina'];

		$user = zastita($user);
		$dogadjaj = zastita($dogadjaj);
		@$kolicina = zastita(@$kolicina);

		if ($user == 0) {
			echo "<div id='error'>Izaberite korisnika</div>";
		}
		else if ($dogadjaj == 0) {
			echo "<div id='error'>Izaberite događaj</div>";
		}
		else if ($kolicina == "") {
			echo "<div id='error'>Izaberite količinu ulaznica</div>";
		}
		else
		{
			$upitUnosRezervacije = "insert into rezervacija values('',$dogadjaj,$user,$kolicina);";
			$rezUpisRez = mysql_query($upitUnosRezervacije, $kon) or die("Error upit");
			if ($rezUpisRez) {
				echo "<div id='success'>Uspešno ste uneli rezervaciju</div>";
			}
			else
			{
				echo "<div id='error'>Rezervacija nije uspešno uneta</div>";
			}
		}
	}
?>
<div class = "forma">
	<h3>Unos rezervacija</h3>
	<hr/>
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" name="adminFormaRezervacija">
		<table>
			<tr>
				<td>Korisničko ime</td>
				<td>
					<select name="ddlUser">
						<option value="0">Izaberi</option>
						<?php
							ddl("korisnik",$kon,"id_korisnik","username");
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Naziv događaja</td>
				<td>
					<select name="ddlDogadjaj">
						<option value="0">Izaberi</option>
						<?php
							ddl("dogadjaj",$kon,"id_dogadjaj","naslov");
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Količina ulaznica</td>
				<td>
					<input type="radio" name="rbKolicina" value="1" />1
					<input type="radio" name="rbKolicina" value="2" />2
					<input type="radio" name="rbKolicina" value="3" />3
					<input type="radio" name="rbKolicina" value="4" />4
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
<div class ="prikaz">
	<h3>Naručene ulaznice</h3>
	<hr/>
	<table>
		<tr>
			<td>Korisničko ime</td>
			<td>Naziv događaja</td>
			<td>Količina</td>
		</tr>
		<?php
			$upitPrikazTabele = "select * from rezervacija r inner join dogadjaj d on r.id_dogadjaj=d.id_dogadjaj inner join korisnik k on r.id_korisnik = k.id_korisnik;";

			$rezPrikazTabele = mysql_query($upitPrikazTabele,$kon);

			while ($redPrikazTabela =mysql_fetch_array($rezPrikazTabele))
			{
				echo "<tr><td>".$redPrikazTabela['username']."</td><td>".$redPrikazTabela['naslov']."</td><td>".$redPrikazTabela['kolicina']."</td></tr>";
			}
		?>
	</table>
</div>
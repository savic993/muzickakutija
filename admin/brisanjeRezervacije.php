<!--<?php
	/*if (isset($_POST['btnIzbrisi'])) {
		$id_rez = $_POST['izbrisi'];

		foreach ($id_rez as $id) {
			$upitBrisanje = "delete from rezervacija where id_rezervacija =".$id.";";
			$rezBrisanje = mysql_query($upitBrisanje,$kon);
		}
		if ($rezBrisanje) {
			echo "<div id='success'>Uspešno ste obrisali rezervacije</div>";
		}
		else
		{
			echo "<div id='error'>Greška pri brisanju</div>";
		}
	}*/
?>-->
<div class="prikaz">
	<h3>Brisanje rezervacija</h3>
	<hr/>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" name="adminBrisanjeRezervacija">
		<table>
			<tr>
				<td>Ime i prezime</td>
				<td>Naslov</td>
				<td>Količina</td>
				<td>Izbriši</td>
			</tr>
			<!--<?php
				/*$rez = prikazTabeleRezervacija($kon);
				foreach($rez as $r)
				{
					echo "<tr><td>".$r['imePrezime']."</td><td>".$r['naslov']."</td><td>".$r['kolicina']."</td><td><input type='checkbox' name='izbrisi[]' value='".$r['id_rezervacija']."'/></td></tr>";
				}*/
			?>-->
			<tr>
				<td colspan="2">
					<input type="submit" name="btnIzbrisi" value="Izbriši" />
					<input type="reset" name="btnRestart" value="Poništi" />
				</td>
			</tr>
		</table>
	</form>
</div>
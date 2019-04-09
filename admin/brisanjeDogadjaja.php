<?php
	if (isset($_POST['btnIzbrisi'])) {
		$id_dog = $_POST['izbrisi'];

		foreach ($id_dog as $id) {
			$upitBrisanje = "delete from dogadjaj where id_dogadjaj =".$id.";";
			$rezBrisanje = mysql_query($upitBrisanje,$kon);
		}
		if ($rezBrisanje) {
			echo "<div id='success'>Uspešno ste obrisali događaje</div>";
		}
		else
		{
			echo "<div id='error'>Greška pri brisanju</div>";
		}
	}
?>
<div class="prikaz">
	<h3>Brisanje događaja</h3>
	<hr/>
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" name="adminBrisanjeDogadjaja">
		<table>
			<tr>
				<td>Naslov</td>
				<td>Datum</td>
				<td>Status</td>
				<td>Izbriši</td>
			</tr>
			<?php
				$dog = prikazAdminTabele("dogadjaj",$kon);
				foreach ($dog as $d) {
					$stat = "";
					$dateTime = $d['vreme'];
					if (time() > $dateTime) {
						$stat = "Prošao";
					}
					else
					{
						$stat = "Aktivan";
					}
					echo "<tr><td>".$d['naslov']."</td><td>".date("M d Y H:i",$d['vreme'])."</td><td>".$stat."</td><td><input type='checkbox' name='izbrisi[]' value='".$d['id_dogadjaj']."'/></td></tr>";
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
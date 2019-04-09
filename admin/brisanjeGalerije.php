<?php
	if (isset($_POST['btnIzbrisi'])) {
		$id_slika = $_POST['izbrisi'];

		foreach ($id_slika as $id_s) {
			$upitBrisanje = "delete from slika where id_slika=".$id_s.";";
			$rezBrisanje = mysql_query($upitBrisanje,$kon);
		}
		if ($rezBrisanje) {
			echo "<div id='success'>Uspešno ste obrisali slike</div>";
		}
		else
		{
			echo "<div id='error'>Greška pri brisanju</div>";
		}
	}
	else if (isset($_POST['btnIzbrisiGaleriju'])) {
		$id_gal = $_POST['izbrisi'];

		foreach ($id_gal as $id_g) {
			$upitBrisanje = "delete from galerija where id_galerija=".$id_g.";";
			$rezBrisanje = mysql_query($upitBrisanje,$kon);
		}
		if ($rezBrisanje) {
			echo "<div id='poruka'>Uspešno ste obrisali galeriju</div>";
		}
		else
		{
			echo "<div id='poruka'>Greška pri brisanju</div>";
		}
	}
?>
<div class="prikaz">
	<h3>Brisanje galerija i slika</h3>
	<hr/>
	<form action="" method="POST" name="adminBrisanjeGalerija">
		<table>
			<tr>
				<td>
					Izaberite galeriju
				</td>
				<td>
					<select name="adminGal" id="adminGal">
						<option value="0">Izaberi</option>
						<?php
							ddl("galerija",$kon,"id_galerija","naziv");
						?>
					</select>
				</td>
			</tr>
		</table>
	</form>
	<form action="" method="POST" name="adminBrisanjeGalerija">
		<div id="slike">
		</div>
	</form>
</div>
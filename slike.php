<?php
	include("konekcija.inc");
	$idGalerije = $_POST['id'];

	if($idGalerije == 0){
		echo "<div id='error'>Izaberite galeriju</div>";
	}
	else
	{
		$upitGalerija = "select * from slika where id_galerija = $idGalerije;";

		$rezGalerija = mysql_query($upitGalerija,$kon);

		if (mysql_num_rows($rezGalerija)<>0) {
			while ($redGalerija = mysql_fetch_array($rezGalerija)) {
				?>
					<div class="slika">
						<?php 
						echo "<img src='".$redGalerija['putanjaM']."' alt='".$redGalerija['alt']."'/><input type='checkbox' name='izbrisi[]' value='".$redGalerija['id_slika']."'/>";
						?>
					</div>
				<?php
			}
			?>
			<br/>
			<div id="tasteri">
				<input type="submit" name="btnIzbrisi" value="Izbriši" />
				<input type="reset" name="btnRestart" value="Poništi" />
			</div>
			<?php
		}
		else
		{
			?>
				<h5>Galerija je prazna. Možete je izbrisati.</h5>
				<div id="brisanjeGalerije">
					<?php
						$upitBrisanjeGalerija = "select * from galerija where id_galerija = $idGalerije;";

						$rezBrisanjeGal = mysql_query($upitBrisanjeGalerija,$kon);
						while ($redBrisanjeGal = mysql_fetch_array($rezBrisanjeGal))
						{
							echo "Potvrdi brisanje <input type='checkbox' name='izbrisi[]' value='".$redBrisanjeGal['id_galerija']."'/>";
						}
					?>
					<input type="submit" name="btnIzbrisiGaleriju" value="Izbriši" />
				</div>
			<?php
		}
	}
?>
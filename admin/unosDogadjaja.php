<?php
	if (isset($_POST['btnIzmeni'])) {
		$datIzmena = $_POST['dtIzmenaDatum'];
		$splitIzmena = split("-", $datIzmena);
		$satIzmena = $_POST['tbIzmenaSat'];
		$minIzmena = $_POST['tbIzmenaMinuti'];

		$satIzmena = zastita($satIzmena);
		$minIzmena = zastita($minIzmena);

		$timeIzmena = mktime($satIzmena,$minIzmena,0,$splitIzmena[1],$splitIzmena[2],$splitIzmena[0]);
		$idDogadjaja = $_POST['hIdDogadjaja'];

		if ($satIzmena < 0 || $satIzmena >= 24) {
			echo "<div id='error'>Sati nisu u dobrom formatu</div>";
		}
		else if ($minIzmena < 0 || $minIzmena >= 60) {
			echo "<div id='error'>Minuti nisu u dobrom formatu</div>";
		}
		else if (time() > $timeIzmena) {
			echo "<div id='error'>Izaberite novi datum i vreme</div>";
		}
		else
		{
			$upitIzmena = "update dogadjaj set vreme=$timeIzmena where id_dogadjaj=$idDogadjaja;";
			$rezDogIzmena = mysql_query($upitIzmena,$kon);
			if ($rezDogIzmena) {
			 	echo "<div id='success'>Uspešno ste promenili vreme događaja</div>";
			}
			else
			{
				echo "<div id='error'>Vreme nije promenjeno</div>";
			} 
		}
	}
	else if (isset($_POST['btnUnesi']))
	{
		$naslov = $_POST['tbNaslov'];
		$tekst = $_POST['taTekst'];
		$datum = $_POST['dtDatum'];
		$niz = explode('-', $datum);
		$sat = $_POST['tbSat'];
		$minut = $_POST['tbMinuti'];

		$naslov = zastita($naslov);
		$tekst = zastita($tekst);

		$vr = mktime($sat,$minut,0,$niz[1],$niz[2],$niz[0]);
		$imeFajla = $_FILES['fSlika']['name'];
		$tmpFajla = $_FILES['fSlika']['tmp_name'];
		$novoIme = time().$imeFajla;
		$putanja = "slike/koncerti/".$novoIme;
		$tipSlike = $_FILES['fSlika']['type'];

		if (strlen($naslov) == 0) {
			echo "<div id='error'>Unesite naslov događaja</div>";
		}
		else if (strlen($tekst) == 0) {
			echo "<div id='error'>Unesite tekst</div>";
		}
		else if (time() > $vr) {
			echo "<div id='error'>Vreme nije buduće</div>";
		}
		else if ($sat < 00 || $sat >= 24) {
			echo "<div id='error'>Sati nisu u dobrom formatu</div>";
		}
		else if ($minut < 00 || $minut >= 60) {
			echo "<div id='error'>Minuti nisu u dobrom formatu</div>";
		}
		else if (($tipSlike <> "image/jpg") && ($tipSlike <> "image/jpeg") && ($tipSlike <> "image/png")) {
			echo "<div id='error'>Slika nije u dobrom formatu</div>";
		}
		else
		{
			if (move_uploaded_file($tmpFajla, $putanja))
			{
				$upitUnosDogadjaja = "insert into dogadjaj values('','$naslov','$tekst',$vr,'$putanja');";
				$rezUpisDog = mysql_query($upitUnosDogadjaja, $kon);
				if ($rezUpisDog) {
					echo "<div id='success'>Uspešno ste uneli događaj</div>";
				}
				else
				{
					echo "<div id='error'>Događaj nije uspešno unet</div>";
				}			
			}
			else
			{
				echo "<div id='error'>Događaj nije uspešno unet. Greška pri upload-u slike!</div>";
			}
		}
	}
?>
<div class="forma">
	<h3>Unos događaja</h3>
	<hr/>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" name="adminFormaDogadjaj" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Naslov</td>
				<td><input type="text" name="tbNaslov"/></td>
			</tr>
			<tr>
				<td>Tekst</td>
				<td><textarea name="taTekst"></textarea></td>
			</tr>
			<tr>
				<td>Datum</td>
				<td><input type="date" name="dtDatum" min="2017-10-01"/></td>
				<td><input type="text" name="tbSat"/></td>
				<td>h</td>
				<td><input type="text" name="tbMinuti"/></td>
				<td>m</td>
			</tr>
			<tr>
				<td>Slika</td>
				<td><input type="file" name="fSlika"/></td>
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
	<h3>Muzički događaji</h3>
	<hr/>
	<table>
		<tr>
			<td>Naslov</td>
			<td>Datum</td>
			<td>Status</td>
			<td>Izmeni</td>
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
				echo "<tr><td>".$d['naslov']."</td><td>".date("M d Y H:i",$d['vreme'])."</td><td>".$stat."</td><td><img src='slike/ikonice/edit.png' alt='izmeni' class='editDog' _idDog='".$d['id_dogadjaj']."' /></td></tr>";
			}
		?>
	</table>
</div>
<div id="izmena">
</div>
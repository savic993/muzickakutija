<?php
	if (isset($_POST['btnUnesi'])) {
		$naziv = $_POST['tbNaziv'];

		if (strlen($naziv) < 1 && strlen($naziv) > 25) {
			echo "<div id='error'>Naziv galerije nije u dobrom formatu</div>";
		}
		else
		{
			$upitUnosGalerije = "insert into galerija values('','$naziv');";
			$rezUpisGal = mysql_query($upitUnosGalerije, $kon);
			if ($rezUpisGal) {
				echo "<div id='success'>Uspešno ste uneli galeriju</div>";
			}
			else
			{
				echo "<div id='error'>Galerija nije uneta</div>";
			}
		}
	}
	else if (isset($_POST['btnUnesiSliku'])) {
		$nazivSlike = $_FILES['fSlika']['name'];
		$tmpSlike = $_FILES['fSlika']['tmp_name'];
		$noviNaziv = time().$nazivSlike;

		$putanjaV = "slike/galerije/velike/".$noviNaziv;
		$putanjaM = "slike/galerije/male/".$noviNaziv;

		$tipSlike = $_FILES['fSlika']['type'];

		$alt = $_POST['tbOpis'];
		$idGalerije = $_POST['ddlGalerija'];

		$putanjaV = zastita($putanjaV);
		$putanjaM = zastita($putanjaM);
		$alt = zastita($alt);



		if (($tipSlike <> "image/jpg") && ($tipSlike <> "image/jpeg") && ($tipSlike <> "image/png")) {
			echo "<div id='error'>Slika nije u dobrom formatu</div>";
		}
		else if ($idGalerije == 0) {
			echo "<div id='error'>Izaberi kojoj galeriji slika pripada</div>";
		}
		else if ((strlen($alt) < 1) && ((strlen($alt) > 25))) {
			echo "<div id='error'>Opis slike nije u dobrom formatu</div>";
		}
		else
		{
			if (move_uploaded_file($tmpSlike, $putanjaV)){
				malaslika($putanjaV,$putanjaM,250,250);
				$upitUnosSlike = "insert into slika values('','$putanjaV','$putanjaM','$alt',$idGalerije);";
				$rezUpisSlike = mysql_query($upitUnosSlike, $kon);
				if ($rezUpisSlike) {
					echo "<div id='success'>Uspešno ste uneli sliku</div>";
				}
				else
				{
					echo "<div id='error'>Slika nije uspešno uneta</div>";
				}
			}
			else
			{
				echo "<div id='error'>Greška pri upload-u slike</div>";
			}
		}

	}
?>
<div id="galerije">
	<div class="forma">
		<h3>Unos galerija</h3>
		<hr/>
		<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" name="adminFormaGalerija">
		<table>
			<tr>
				<td>Naziv</td>
				<td><input type="text" name="tbNaziv"/></td>
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
		<h3>Prikaz galerija</h3>
		<hr/>
		<table>
			<tr>
				<td>Naziv</td>
				<td>Broj slika</td>
			</tr>
			<?php
				$upitPrikazBrojaSlika = "select count(s.id_galerija) as broj,naziv FROM slika s inner join galerija g on s.id_galerija=g.id_galerija group by naziv;";

				$galRez = mysql_query($upitPrikazBrojaSlika,$kon)or die("Error upit");
				while ($redPrikazTabela =mysql_fetch_array($galRez))
				{
					echo "<tr><td>".$redPrikazTabela[1]."</td><td>".$redPrikazTabela[0]."</td></tr>";
				}
			?>
		</table>
	</div>
</div>
<div id="slike">
	<div class="forma">
		<h3>Unos slika u galeriju</h3>
		<hr/>
		<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" name="adminFormaSlike" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Galerija</td>
				<td>
					<select name="ddlGalerija">
						<option value="0">Izaberi</option>
						<?php
							ddl("galerija",$kon,"id_galerija","naziv");
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Slika</td>
				<td><input type="file" name="fSlika"></td>
			</tr>
			<tr>
				<td>Opis</td>
				<td><input type="text" name="tbOpis"></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="btnUnesiSliku" value="Unesi" />
					<input type="reset" name="btnRestart" value="Poništi" />
				</td>
			</tr>
		</table>
	</form>
	</div>
</div>
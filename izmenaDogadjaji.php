<?php
	include("konekcija.inc");
	include("funkcije.inc");

	$idDog = $_POST['idDog'];
	
	$upit = "select * from dogadjaj where id_dogadjaj = $idDog;";

	$rez = mysql_query($upit,$kon);

	if (mysql_num_rows($rez) == 1) {
		$red = mysql_fetch_array($rez);
		echo "<h3>Promena termina događaja ".$red['naslov']."</h3><hr/>";
		echo "<form action='' method='POST' name='formaIzmenaDogadjaja'>
				<table>
					<tr>
						<td>
							Datum
						</td>
						<td>
							<input type='date' name='dtIzmenaDatum' min='2017-10-01'/>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<label>Sati</label>
							<input type='text' name='tbIzmenaSat'/>
							<label>Minuti</label>
							<input type='text' name='tbIzmenaMinuti'/>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<input type='hidden' name='hIdDogadjaja' value='".$idDog."'/>
							<input type='submit' name='btnIzmeni' value='Potvrdi' />
						</td>
					</tr>
				</table>
			</form>";
	}
?>
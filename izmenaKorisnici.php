<?php
	include("konekcija.inc");
	include("funkcije.inc");

	$idKor = $_POST['idKor'];
	
	if (isset($idKor)) {
		$upit = "select * from korisnik where id_korisnik = $idKor;";

		$rez = mysql_query($upit,$kon);

		if (mysql_num_rows($rez) == 1) {
			$red = mysql_fetch_array($rez);
			echo "<h3>Promena uloge korisniku ".$red['imePrezime']."</h3><hr/>";
			echo "<form action='' method='POST' name='formaIzmenaKorisnika'>
					<table>
						<tr>
							<td>
								Uloga
							</td>
							<td>
								<select name='ddlUlogaIzmena'>
									<option value='0'>Izaberi</option>"
									?>
										<?php 
											ddl('uloga',$kon,'id_uloga','naziv');
										?>
									<?php
						echo 	"</select>
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<input type='hidden' name='hIdKorisnika' value='".$idKor."'/>
								<input type='submit' name='btnIzmeni' value='Potvrdi' />
							</td>
						</tr>
					</table>
				</form>";
		}
	}
?>
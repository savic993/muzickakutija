<?php
if (isset($_GET['u']) && isset($_GET['g'])) {
		
		$g = $_GET['g'];

		$upitSlike = "select * from galerija g inner join slika s on g.id_galerija=s.id_galerija where s.id_galerija=$g;";
		$rezSlike = mysql_query($upitSlike,$kon);

		if (@mysql_num_rows($rezSlike) <> 0) {
			while ($redSlike = mysql_fetch_array($rezSlike)) {
				echo "<div class='slika'><a href='".$redSlike['putanjaV']."'><img src='".$redSlike['putanjaM']."' alt='".$redSlike['alt']."' /></a></div>";
			}
		}
		else
		{
			include("404.php");
		}
	}
else if (isset($_GET['u'])) {
	$upitGal = "select * from galerija;";
	$rezGal = mysql_query($upitGal,$kon);

	if (mysql_num_rows($rezGal) <> 0) {
		while ($redGal = mysql_fetch_array($rezGal)) {
			echo "<a href='index.php?u=3&g=".$redGal['id_galerija']."'><div class='album'>";
			$upitGalerija = "select * from galerija g inner join slika s on g.id_galerija=s.id_galerija where s.id_galerija=".$redGal['id_galerija']." limit 1;";
			$rezGalerija = mysql_query($upitGalerija,$kon);
			if (mysql_num_rows($rezGalerija) == 1) {
				$redGalerija = mysql_fetch_array($rezGalerija);
				echo "<div class='slicica'><img src='".$redGalerija['putanjaM']."' alt='".$redGalerija['alt']."'/></div>";
			}
			echo "<div class='naslov'><h5>".$redGal['naziv']."</h5></div></div></a>";
		}
	}
	else
	{
		echo "<div id='error'>Trenutno nema galerija</div>";
	}
}
?>
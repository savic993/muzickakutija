<h2>Svi predstojeći događaji naše muzičke scene</h2>
<?php
	$poStrani = 5;
	if (isset($_GET['str'])) {
		$str = $_GET['str'];
	}
	else
	{
		$str = 0;
	}

	$upitBrSvih = "select count(id_dogadjaj) from dogadjaj;";
	$rezBrSvi = mysql_query($upitBrSvih,$kon);
	if(mysql_num_rows($rezBrSvi) == 0)
	{
		echo "<div id='error'>Zao nam je. Trenutno nema podataka.</div>";
	}
	else
	{
		$redBrSvi = mysql_fetch_array($rezBrSvi);
		$ukupno = $redBrSvi[0];
		$levo = $str - $poStrani;
		$desno = $str + $poStrani;

		if ($levo < 0 ) {
			echo "<div id='navigacija'><span class='pocetak'>Pocetak</span><span><a href='index.php?u=2&str=".$desno."'>Sledeci</a></span></div>";
		}
		else if ($desno > $ukupno) {
			echo "<div id='navigacija'><span><a href='index.php?u=2&str=".$levo."'>Prethodni</a></span><span class='kraj'>Kraj</span></div>";
		}else
		{
			echo "<div id='navigacija'><span><a href='index.php?str=".$levo."'>Prethodni</a></span><span><a href='index.php?u=2&str=".$desno."'>Sledeci</a></span></div>";
		}

		$upitPrikazSvih = "select * from dogadjaj order by vreme desc limit $poStrani offset $str ;";

		$rezSvi = mysql_query($upitPrikazSvih,$kon);
		
		if(@mysql_num_rows($rezSvi) == 0)
		{
			include("404.php");
		}else
		{
			while($r=mysql_fetch_array($rezSvi)) 
			{
				$time = $r['vreme'];
				if (time() < $time) {
					echo "<div class='post'><div class='postSlika'><img src='".$r['putanja']."' alt='".$r['naslov']."'/></div><div class='tekst'><h5>".$r['naslov']."</h5><h6>".date("M d Y H:i",$r['vreme'])." h</h6><p>".$r['tekst']."</p></div><div class='dugmePost'><a class='link' href='index.php?u=4'>Rezerviši kartu</a></div></div><div class='cisti'></div>";
				}
				else
				{
					echo "<div class='post'><div class='postSlika'><img src='".$r['putanja']."' alt='".$r['naslov']."'/></div><div class='tekst'><h5>".$r['naslov']."</h5><h6>".date("M d Y H:i",$r['vreme'])." h</h6><p>".$r['tekst']."</p></div><div class='dugmePost'><form action='rezervacija.php' method='POST' name='rezervacija' id='rezervacija'><div id='proslo'><b>Prošao</b></div></form></div></div><div class='cisti'></div>";
				}
			}
		}
	}
?>
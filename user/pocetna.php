<h2>Najnoviji događaji</h2>
<?php
	$post = prikazPost("dogadjaj",$kon);
	foreach ($post as $p) 
	{
		$time = $p['vreme'];
		if (time() < $time) {
			echo "<div class='post'><div class='postSlika'><img src='".$p['putanja']."' alt='".$p['naslov']."'/></div><div class='tekst'><h5>".$p['naslov']."</h5><h6>".date("M d Y H:i",$p['vreme'])." h</h6><p>".$p['tekst']."</p></div><div class='dugmePost'><a class='link' href='index.php?u=4'>Rezerviši kartu</a></div></div>";
		}
	}
?>
<?php
	if (isset($_GET['a']) && $_GET['a']==3) {
		?>
		<div id="adminMeni">
			<ul>
				<li><a href="index.php?a=3&p=1">Korisnici</a></li>
				<li><a href="index.php?a=3&p=2">Rezervacije</a></li>
			</ul>
		</div>
		<div class="cisti"></div>
		<div id="adminPanel">
		<?php
		if (isset($_GET['p'])) 
		{
			$p = $_GET['p'];
			switch ($p) 
			{
				case '1':
					include('filterKorisinici.php');
					break;
				case '2':
					include('filterRezervacije.php');
					break;
				default:
					include('404.php');
					break;
			}
		}
		else
		{
			header('Location:index.php?a=3&p=1');
		}
		?>
			</div>
		<?php
	}
?>
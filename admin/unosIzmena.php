<?php
	if (isset($_GET['a']) && $_GET['a']==1) {
		?>
		<div id="adminMeni">
			<ul>
				<li><a href="index.php?a=1&p=1">Korisnici</a></li>
				<li><a href="index.php?a=1&p=2">Rezervacije</a></li>
				<li><a href="index.php?a=1&p=3">Galerije i slike</a></li>
				<li><a href="index.php?a=1&p=4">Događaji</a></li>
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
					include('unosKorisnici.php');
					break;
				case '2':
					include('unosRezervacije.php');
					break;
				case '3':
					include('unosGalerije.php');
					break;
				case '4':
					include('unosDogadjaja.php');
					break;
				default:
					include('404.php');
			}
		}
			else
			{
				header('Location:index.php?a=1&p=1');
			}
		?>
		</div>
		<?php
	}
?>
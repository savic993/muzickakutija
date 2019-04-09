<?php
	if (isset($_GET['a']) && $_GET['a']==2) {
		?>
		<div id="adminMeni">
			<ul>
				<li><a href="index.php?a=2&p=1">Korisnici</a></li>
				<li><a href="index.php?a=2&p=2">Rezervacije</a></li>
				<li><a href="index.php?a=2&p=3">Galerije i slike</a></li>
				<li><a href="index.php?a=2&p=4">Događaji</a></li>
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
							include('brisanjeKorisnici.php');
							break;
						case '2':
							include('brisanjeRezervacije.php');
							break;
						case '3':
							include('brisanjeGalerije.php');
							break;
						case '4':
							include('brisanjeDogadjaja.php');
							break;
						default:
							include('404.php');
							break;
					}
				}
				else
				{
					header('Location:index.php?a=2&p=1');
				}
			?>
		</div>
		<?php
	}
?>
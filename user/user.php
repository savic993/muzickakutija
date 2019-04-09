<?php
	if (@$_GET['x'] == 2) {
			include('autor.php');
		}
	else if (isset($_GET['u'])) {
		$u = $_GET['u'];
		switch ($u) {
			case '1':
				include('pocetna.php');
				break;
			case '2':
				include('dogadjaji.php');
				break;
			case '3':
				include('galerija.php');
				break;
			case '4':
				include('rezervacija.php');
				break;
			case '5':
				include('profil.php');
				break;
			
			default:
				include('404.php');
				break;
		}
	}
	else
	{
		header('Location:index.php?u=1');
	}
?>
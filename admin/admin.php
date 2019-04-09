<?php
	if ($_GET['x'] == 2) {
		include('autor.php');
	}
	else if (isset($_GET['a'])) 
	{
		$a = $_GET['a'];
		switch ($a) {
			case '1':
				include('unosIzmena.php');
				break;
			case '2':
				include('brisanje.php');
				break;
			case '3':
				include('filtriranje.php');
				break;
			default:
				include('404.php');
				break;
		}
	}
	else
	{
		header('Location:index.php?a=1&p=1');
	}
?>
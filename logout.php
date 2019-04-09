<?php
	if (isset($_SESSION["id_uloga"])) {
		echo "<div id='odjava'><h5>".$_SESSION["username"]."</h5><a href='index.php?logout=1'>Odjavi se</a></div>";
		if (isset($_GET["logout"]) && $_GET["logout"] == 1) {
			session_destroy();
			header('Location:index.php');
		}
	}
?>
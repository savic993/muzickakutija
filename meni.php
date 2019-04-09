<div id="naslov">
	<h1><a href="index.php">Muzička kutija</a></h1>
	<h3>Svi događaji domaće muzike</h3>
</div>
<div id="meniSadrzaj">
	<?php 
		if (isset($_SESSION["id_uloga"]) && ($_SESSION["id_uloga"] == 1)) {
			include("admin/adminMeni.php");
		}
		else if (isset($_SESSION["id_uloga"]) && ($_SESSION["id_uloga"] == 2)) {
			include("user/userMeni.php");
		}
	?>	
</div>
<?php
	if (isset($_SESSION["id_uloga"])) {
		include("logout.php");
	}
	else
	{
		if (@$_GET['x'] != 1) {
			?>
				<div id="registracija">
					<h3><a href="index.php?x=1">Registrujte se</a></h3>
				</div>
			<?php
		}
	}
?>
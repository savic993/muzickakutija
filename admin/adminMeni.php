<div id="okvirMeni">
	<?php
		$upitMeni = "select * from meni where id_uloga=1;";
		$rezMeni = mysql_query($upitMeni,$kon);
		echo "<ul>";
		while ($nizMeni = mysql_fetch_array($rezMeni)) {
			echo "<li><a href='".$nizMeni['link']."'>".$nizMeni['naziv']."</a></li>";
		}
		echo "</ul>";
	?>
</div>
<div id="okvirMeni">
	<?php
		$upitMeniUser = "select * from meni where id_uloga=2;";
		$rezMeniUser = mysql_query($upitMeniUser,$kon);
		echo "<ul>";
		while ($redMeniUser = mysql_fetch_array($rezMeniUser)) {
			echo "<li><a href='".$redMeniUser['link']."'>".$redMeniUser['naziv']."</a></li>";
		}
		echo "</ul>";
	?>
</div>
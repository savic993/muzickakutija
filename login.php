<div id="logovanje">
	<form action="" id="formLog" method="POST" name="fLogin" onsubmit="return logovanje();">
		<table>
			<tr>
				<td class="prva">Korisničko ime</td>
				<td><input type="text" name="tbUsername" id="tbUsername" /></td>
			</tr>
			<tr>
				<td class="prva">Lozinka</td>
				<td><input type="password" name="tbLozinka" id="tbLozinka" /></td>
			</tr>
			<tr>
				<td colspan="2" class="dugme"><input type="submit" name="btnLogin" value="Prijavi se"/></td>
			</tr>
		</table>		
	</form>
</div>
<?php
	if (isset($_POST["btnLogin"])) {
		$u = $_POST["tbUsername"];
		$p = $_POST["tbLozinka"];

		$user = zastita($u);
		$password = md5($p);

		$upitLogin = "select * from korisnik k inner join uloga u on k.id_uloga = u.id_uloga where username='".$user."' and password='".$password."';";

		$rezLogin = mysql_query($upitLogin,$kon);
		if (mysql_num_rows($rezLogin) == 1) {
			$nizLogin = mysql_fetch_array($rezLogin);
			$_SESSION['username'] = $nizLogin['username'];
			$_SESSION['id_uloga'] = $nizLogin['id_uloga'];
			$_SESSION['id_korisnik'] = $nizLogin['id_korisnik'];
			header('Location:index.php');
		}
		else
		{
			echo "<div id='error'>Greska pri logovanju!</div>";
		}
	}
?>
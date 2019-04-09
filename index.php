<?php
	include("konekcija.inc");
	include("funkcije.inc");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Muzicka kutija</title>
	<script type="text/javascript" src="js/skripta.js"></script>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
	<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="css/jquery.lightbox-0.5.css"/>
	<script type="text/javascript" src="lib/jquery.lightbox-0.5.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/stil.css"/>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$("#adminGal").change(function(){
				var id_gal = document.getElementById('adminGal').options[document.getElementById('adminGal').selectedIndex].value;

				$.ajax({
					type:'POST',
					url:'slike.php',
					data:{
						id: id_gal
					},
					success: function(respond){
						$('#slike').html(respond);
					}
				});
			});

			$("#btnPretragaKorisnici").click(function(){
				var user = document.getElementById('tbUsername').value;
				var imePrezime = document.getElementById('tbImePrezime').value;	

				$.ajax({
					type:'POST',
					url:'pretragaKorisnici.php',
					data:{
						username: user,
						imePrezime: imePrezime
					},
					success: function(respond){
						$('#filter').html(respond);
					}
				});
			});

			$('#btnPretragaRezervacija').click(function(){
				var user = document.getElementById('tbUsername').value;
				var naslov = document.getElementById('tbNazivDogadjaja').value;	

				$.ajax({
					type:'POST',
					url:'pretragaRezervacija.php',
					data:{
						username: user,
						naslov: naslov
					},
					success: function(respond){
						$('#filter').html(respond);
					}
				});
			});

			$('.edit').click(function(){
				var idKor = $(this).attr("_idKor");

				$.ajax({
					type:'POST',
					url:'izmenaKorisnici.php',
					data:{
						idKor: idKor
					},
					success: function(respond){
						$('#izmena').html(respond);
					}
				});
			});

			$('.editDog').click(function(){
				var idDog = $(this).attr("_idDog");

				$.ajax({
					type:'POST',
					url:'izmenaDogadjaji.php',
					data:{
						idDog: idDog
					},
					success: function(respond){
						$('#izmena').html(respond);
					}
				});
			});

			$('.delete').click(function(){
				var idRezervacija = $(this).attr("_idRez");
				var url = window.location.href;
				
				$.ajax({
					type:'POST',
					url:'brisanjeRezervacije.php',
					data:{
						idRezervacija: idRezervacija
					},
					success: function(respond){
						$('body').load(url);
					}
				});
			});

			$('.deleteAdresa').click(function(){
				var idAdresa = $(this).attr("_idAdr");
				var idKorisnik = $(this).attr("_idKor");
				var url = window.location.href;

				$.ajax({
					type:'POST',
					url:'brisanjeAdresa.php',
					data:{
						idAdresa: idAdresa,
						idKorisnik: idKorisnik
					},
					success: function(respond){
						$('body').load(url);
					}
				});
			});

		});
	</script>
</head>
<body>
	<div id="meni">
		<?php
			include("meni.php");
		?>
	</div>
	<div class="cisti"></div>
	<div id="sadrzaj" class="centar">
		<?php
			if (isset($_SESSION["id_uloga"]) && ($_SESSION["id_uloga"] == 1)) {
				include("admin/admin.php");
			}
			else if (isset($_SESSION["id_uloga"]) && ($_SESSION["id_uloga"] == 2)) {
				include("user/user.php");
			}
			else if (isset($_GET["x"]) && ($_GET["x"] == 1)) {
				include("registracija.php");
			}
			else if (isset($_GET["x"]) && ($_GET["x"] == 2)) {
				include("autor.php");
			}
			else
			{
				echo "<h5>Pokrenite vašu muzičku kutiju</h5>";
				include("login.php");
			}
		?>
	</div>
	<div class="cisti"></div>
	<div id="futer">
		<?php
			include("futer.php");
		?>
	</div>
	<script type="text/javascript">
		$(function() {
   			$('#sadrzaj .slika a').lightBox();
		});
		/*$(function() {
   			$('#sadrzaj .slika .male a').lightBox();
		});
		$(function() {
   			$('#sadrzaj .slika .velike a').lightBox();
		});*/
	</script>
</body>
</html>
<?php
	include("zatvori.inc");
?>
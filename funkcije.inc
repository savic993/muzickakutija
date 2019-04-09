<?php
	function zastita($prom){
			$p = trim($prom);
			$p = addslashes($prom);
			return $p;
		}
	function ddl($tabela,$konekcija,$kolona1,$kolona2){
		if ($konekcija) {
			$upitDDL = "select * from $tabela";
			$rezDDL = mysql_query($upitDDL,$konekcija);
			while ($redDDL = mysql_fetch_array($rezDDL))
			{
				echo "<option value='".$redDDL["$kolona1"]."'>".$redDDL["$kolona2"]."</option>";
			}
		}
	}

	function prikazAdminTabele($tabela,$konekcija){
		$niz = array();
		if ($konekcija) {
			$upitPrikazAdminTabela = "select * from $tabela;";
			$rezPrikazTabela = mysql_query($upitPrikazAdminTabela, $konekcija);
			while ($redPrikazTabela = mysql_fetch_array($rezPrikazTabela)) {
				$niz[] = $redPrikazTabela;
			}
		}
		return $niz;
	}

	function prikazTabeleRezervacija($konekcija){
		$niz = array();
		if ($konekcija) {
			$upitPrikazRez = "select * from rezervacija r inner join dogadjaj d on r.id_dogadjaj=d.id_dogadjaj inner join korisnik k on r.id_korisnik = k.id_korisnik;";
			$rezPrikazRez = mysql_query($upitPrikazRez,$konekcija);
			while ($redPrikaz = mysql_fetch_array($rezPrikazRez)) {
				$niz[] = $redPrikaz;
			}
		}
		return $niz;
	}

	function prikazPost($tabelaPost,$konekcijaPost){
		$nizPost = array();
		if ($konekcijaPost) {
			$upitPost = "select * from dogadjaj order by vreme asc limit 5;";
			$rezPost = mysql_query($upitPost, $konekcijaPost);
			while ($redPost = mysql_fetch_array($rezPost)) {
				$nizPost[] = $redPost;
			}
		}
		return $nizPost;
	}

	function malaslika($name,$filename,$new_w,$new_h){
		$system=explode('.',$name);
		if (preg_match('/jpg|jpeg/i',$system[1])){
			$src_img=imagecreatefromjpeg($name);
		}
		if (preg_match('/png/i',$system[1])){
			$src_img=imagecreatefrompng($name);
		}

		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
		if ($old_x > $old_y) {
			$thumb_w=$new_w;
			$thumb_h=$old_y*($new_h/$old_x);
		}
		if ($old_x < $old_y) {
			$thumb_w=$old_x*($new_w/$old_y);
			$thumb_h=$new_h;
		}
		if ($old_x == $old_y) {
			$thumb_w=$new_w;
			$thumb_h=$new_h;
		}

		$dst_img=imagecreatetruecolor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);


		if (preg_match("/png/i",$system[1])){
			imagepng($dst_img,$filename);
	    } else {
		  	imagejpeg($dst_img,$filename);
		}
		imagedestroy($dst_img);
		imagedestroy($src_img);
	}
?>
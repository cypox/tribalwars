<?php
	if ($_GET['akcja'] == 'nowa_kategoria' and isset($_POST)) {
		if (strlen($_POST['nazwa']) < 5) {
			$err = 'Nazwa jest za kr�tka[5-50]';
			} else {
			if (strlen($_POST['nazwa']) > 50) {
				$_POST['nazwa'] = urlencode($_POST['nazwa']);
				$err = 'Nazwa jest za d�uga [5-50]'; 

				} else {
			if (strlen($_POST['typ']) > 2) {
				$_POST['typ'] = urlencode($_POST['typ']);
				$err = 'ID Kategorii mo�e zawiera� max 2 znaki';  
				} else {
			if (strlen($_POST['typ']) < 1) {
				$_POST['typ'] = urlencode($_POST['typ']);
				$err = 'Musisz posda� ID kategorii!';  				
			} else {
				$db->query("INSERT INTO zasady(typ,nazwa) VALUES('".$_POST['typ']."','".$_POST['nazwa']."')");
				header('LOCATION: admin.php?screen=rules');
				exit;
				}
			}
		}
    }
}
	if ($_GET['akcja'] == 'nowa_zasada' and isset($_POST)) {
		if (strlen($_POST['kt']) < 1) {
			$err = 'Musisz wybra� kategori�!';

				} else {
			if (strlen($_POST['text']) < 5) {
				$err = 'Tre�� zasady jest za kr�tka[5-1000]';  
				} else {
			if (strlen($_POST['text']) > 1000) {
				$_POST['text'] = urlencode($_POST['text']);
				$err = 'Tre�� zasady jest za d�uga[5-1000]';  				
			} else {
				$db->query("INSERT INTO lista_zasad(kategoria,text) VALUES('".$_POST['kt']."','".$_POST['text']."')");
				header('LOCATION: admin.php?screen=rules');
				exit;
				}
			}
		}
    }

//pobierz list� kategorii z bazy danych:
	$query['big_arr'] = $db->query("SELECT * FROM `zasady`");
	while ($tm_info = $db->fetch($query['big_arr'])) {

		$zasady[$tm_info['id']]['id'] = urldecode($tm_info['id']);
		$zasady[$tm_info['id']]['typ'] = urldecode($tm_info['typ']);
        $zasady[$tm_info['id']]['nazwa'] = urldecode($tm_info['nazwa']);
	



		}

	

$tpl->assign('zasady',$zasady);
$tpl->assign('err',$err);
		

?>

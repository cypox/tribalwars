<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(isset($_GET['action']) && $_GET['action'] == "change" && $user['ally_found'] == 1){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	$new_name = "";
	$name = trim($_POST['name']);
	if(empty($error) && $name != $ally['name']){
		if(empty($error) && strlen($name) < 4){
			$error = "Desculpe, más o nome da tribo deve ter entre 4 e 32 caracteres!";
		}
		if(empty($error) && strlen($name) > 32){
			$error = "Desculpe, más o nome da tribo deve ter entre 4 e 32 caracteres!";
		}
		$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `ally` WHERE `name`='".parse($name)."'");
		$row = $db->fetch($result);
		if(empty($error) && $row['count'] > 0){
			$error = "Desculpe, más o nome '".$_POST['name']."' já está em uso!";
		}
		$new_name = parse($name);
	}
	$new_tag = "";
	$tag = trim($_POST['tag']);
	if(empty($error) && $tag != $ally['short']){
		if(empty($error) && strlen($tag) < 2){
			$error = "Desculpe, más a TAG da tribo deve ter entre 2 e 6 caracteres!";
		}
		if(empty($error) && strlen($tag) > 6){
			$error = "Desculpe, más a TAG da tribo deve ter entre 2 e 6 caracteres!";
		}
		$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `ally` WHERE `short`='".parse($tag)."'");
		$row = $db->fetch($result);
		if(empty($error) && $row['count'] > 0){
			$error = "Desculpe, más a TAG '".$_POST['tag']."' já está em uso!";
		}
		$new_tag = parse($tag);
	}

	$hp = trim($_POST['homepage']);
	if(empty($error) && strlen($hp) > 128){
		$error = "Desculpe, más a 'Homepage' não pode exeder 128 caracteres!";
		$hp = parse($hp);
	}
	$irc = trim($_POST['irc-channel']);
	if(empty($error) && strlen($irc) > 128){
		$error = "Desculpe, más o IRC não pode exeder 128 caracteres!";
		$irc = parse($irc);
	}
	if(empty($error)){
		$querys = array();
		$querys[] = "homepage='".$hp."'";
        $querys[] = "irc='".$irc."'";
		if(!empty($new_name)){
			$querys[] = "name='".$new_name."'";
		}
		if(!empty($new_tag)){
			$querys[] = "short='".$new_tag."'";
		}
		$db->query("UPDATE `ally` SET ".implode(",", $querys)." WHERE `id`='".$user['ally']."'");
        $d->open();
		header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=properties");
	}
}
if(isset($_GET['action']) && $_GET['action'] == "close" && $user['ally_found'] == 1){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(!$config['close_ally']) $error = "Desculpe, más está ação não está permitida!";

	if(empty($error)){
        $result = $db->query("SELECT `id` FROM `users` WHERE `ally`='".$user['ally']."'");
		while($row = $db->fetch($result)){
			$cl_reports->ally_close($user['username'], $user['id'], $row['id']);
			$db->query("UPDATE `users` SET `ally`='-1' WHERE `id`='".$row['id']."'");
		}
		$db->query("DELETE FROM `ally_invites` WHERE `from_ally`='".$user['ally']."'");
		$db->query("DELETE FROM `ally_events` WHERE `ally`='".$user['ally']."'");
		$db->query("DELETE FROM `ally` WHERE `id`='".$user['ally']."'");
		reload_ally_rangs();
		reload_kill_ally();
		$d->open();
		header("LOCATION: game.php?village=".$village['id']."&screen=ally");
	}
}
if(isset($_GET['action']) && $_GET['action'] == "change_desc" && $user['ally_diplomacy'] == 1){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(empty($error) && strlen($_POST['desc_text']) > 10000){
		$error = "Desculpe, más você não pode exeder 10000 caracteres!";
	}
	if(empty($error)){
		if(isset($_POST['preview'])){
			$preview = htmlspecialchars(nl2br($_POST['desc_text']));
			$ally['edit_description'] = htmlspecialchars($_POST['desc_text']);
			$ally['description'] = nl2br(htmlspecialchars($_POST['desc_text']));
		}
		if(isset($_POST['edit'])){
			$text = parse($_POST['desc_text']);
			$db->query("UPDATE `ally` SET `description`='".$text."' WHERE `id`='".$user['ally']."'");
			add_allyevent($user['ally'], "<a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a> alterou o perfil da tribo.");
			$d->open();
			header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=properties");
			exit;
		}
	}
	$d->open();
}
if(isset($_GET['action']) && $_GET['action'] == "ally_image" && $user['ally_diplomacy'] == 1){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(@$_POST['del_image'] == 'on' && !empty($ally['image'])){
		$db->query("UPDATE `ally` SET `image`='' WHERE `id`='".$user['ally']."'");
		@unlink("./graphic/ally/".$ally['image']);

		if(empty($_FILES['image']['name'])){
			$c->open();
			header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=properties");
			exit;
		}
		$ally['image'] = '';
	}
	if(!empty($_FILES['image']['name'])){
		$image = $_FILES['image'];
		$valid_types = array('image/jpeg','image/pjpeg','image/png','image/gif');
		if(empty($error) && !in_array($image['type'],$valid_types)){
			$error = "Desculpe más só são permitidas formatos JPEG, JPG, PNG ou GIF!";
		}
		if(empty($error) && $image['size'] > 242144){
			$error = "Desculpe, más o brasão não pode exeder 256kByte!";
		}
		$size_coords = getimagesize($image['tmp_name']);
		if(empty($error) && ($size_coords[0] > 300 && $size_coords[1] > 200)){
			$error = "Desculpe, más a imagem não pode ser maior que 300x200px!";
		}
		if(empty($error)){
			if(!empty($ally['image'])){
				$db->query("UPDATE `ally` SET `image`='' WHERE `id`='".$user['ally']."'");
				@unlink("./graphic/ally/".$ally['image']);
			}
			$filename = $user['ally'];
			$rand = rand(1, 9999999);
            if($image['type'] == "image/jpeg" && $image['type'] == "image/pjpeg"){
				copy($image['tmp_name'], "graphic/ally/".$filename."-".$rand.".jpeg");
				$file = $filename."-".$rand.".jpeg";
			}
			if($image['type'] == "image/png"){
				copy($image['tmp_name'], "graphic/ally/".$filename."-".$rand.".png");
				$file = $filename."-".$rand.".png";
			}
			if($image['type'] == "image/gif"){
				copy($image['tmp_name'], "graphic/ally/".$filename."-".$rand.".gif");
				$file = $filename."-".$rand.".gif";
			}
			$db->query("UPDATE `ally` SET `image`='".$file."' WHERE `id`='".$user['ally']."'");
			$d->open();
			header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=properties");
			exit;
		}
	}elseif(empty($error)){
		$error = "Desculpe, más nenhuma imagem foi selecionada!";
	}
}
$tpl->assign("preview", $preview);
?>
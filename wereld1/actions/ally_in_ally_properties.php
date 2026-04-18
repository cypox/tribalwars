<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != "sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL"){
	exit;
}

if(isset($_GET['action']) && $_GET['action'] == "change" && $user['ally_found'] == 1){
	$d = new do_action($user['id']);
	$d->close();
	if($session['hkey'] != $_GET['h']){
		$error = "Sorry, but the security code is invalid!";
	}
	$new_name = "";
	$name = trim($_POST['name']);
	if(empty($error) && $name != $ally['name']){
		if(empty($error) && strlen($name) < 4){
			$error = "Sorry, but the tribe name must be between 4 and 32 characters!";
		}
		if(empty($error) && strlen($name) > 32){
			$error = "Sorry, but the tribe name must be between 4 and 32 characters!";
		}
		$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `ally` WHERE `name`='".parse($name)."'");
		$row = $db->fetch($result);
		if(empty($error) && $row['count'] > 0){
			$error = "Sorry, but the name '".$_POST['name']."' is already in use!";
		}
		$new_name = parse($name);
	}
	$new_tag = "";
	$tag = trim($_POST['tag']);
	if(empty($error) && $tag != $ally['short']){
		if(empty($error) && strlen($tag) < 2){
			$error = "Sorry, but the tribe TAG must be between 2 and 6 characters!";
		}
		if(empty($error) && strlen($tag) > 6){
			$error = "Sorry, but the tribe TAG must be between 2 and 6 characters!";
		}
		$result = $db->query("SELECT COUNT(`id`) AS `count` FROM `ally` WHERE `short`='".parse($tag)."'");
		$row = $db->fetch($result);
		if(empty($error) && $row['count'] > 0){
			$error = "Sorry, but the TAG '".$_POST['tag']."' is already in use!";
		}
		$new_tag = parse($tag);
	}

	$hp = trim($_POST['homepage']);
	if(empty($error) && strlen($hp) > 128){
		$error = "Sorry, but the 'Homepage' cannot exceed 128 characters!";
		$hp = parse($hp);
	}
	$irc = trim($_POST['irc-channel']);
	if(empty($error) && strlen($irc) > 128){
		$error = "Sorry, but the 'IRC' cannot exceed 128 characters!";
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
		exit;
	}
	$d->open();
}
if(isset($_GET['action']) && $_GET['action'] == "close" && $user['ally_found'] == 1){
	if($session['hkey'] != $_GET['h']){
		$error = "Sorry, but the security code is invalid!";
	}
	if(!$config['close_ally']) $error = "Sorry, but this action is not permitted!";

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
		$error = "Sorry, but the security code is invalid!";
	}
	if(empty($error) && strlen($_POST['desc_text']) > 10000){
		$error = "Sorry, but you cannot exceed 10000 characters!";
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
			add_allyevent($user['ally'], "<a href=\"game.php?village=;&screen=info_player&id=".$user['id']."\">".entparse($user['username'])."</a> updated the tribe profile.");
			$d->open();
			header("LOCATION: game.php?village=".$village['id']."&screen=ally&mode=properties");
			exit;
		}
	}
	$d->open();
}
if(isset($_GET['action']) && $_GET['action'] == "ally_image" && $user['ally_diplomacy'] == 1){
	if($session['hkey'] != $_GET['h']){
		$error = "Sorry, but the security code is invalid!";
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
			$error = "Sorry, but only JPEG, JPG, PNG or GIF formats are allowed!";
		}
		if(empty($error) && $image['size'] > 242144){
			$error = "Sorry, but the coat of arms cannot exceed 256kByte!";
		}
		$size_coords = getimagesize($image['tmp_name']);
		if(empty($error) && ($size_coords[0] > 300 && $size_coords[1] > 200)){
			$error = "Sorry, but the image cannot be larger than 300x200px!";
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
		$error = "Sorry, but no image was selected!";
	}
}
$tpl->assign("preview", $preview);
?>
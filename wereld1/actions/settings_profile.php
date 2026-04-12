<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD != 'sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL'){
	exit;
}

if(isset($_GET['action']) && $_GET['action'] == 'change_profile'){
	$c = new do_action($user['id']);
	$c->close();

	if(@$session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}

	$day = (int)@$_POST['day'];
	$month = (int)@$_POST['month'];
	$year = (int)@$_POST['year'];
	if(!checkdate($month,$day,$year)){
		$day = 0;
		$month = 1;
		$year = 0;
	}
	if(date("Y") < $year+5){
		$day = 0;
		$month = 1;
		$year = 0;	
	}

	$geschlecht = @$_POST['sex'];
	if($geschlecht != 'f' && $geschlecht != 'm'){
		$geschlecht = 'x';
	}

	$wohnort = substr(@$_POST['home'],0,32);

	if(@$_POST['del_image'] == 'on' && !empty($user['image'])){
	    $db->query("UPDATE `users` SET `image`='' WHERE `id`='".$user['id']."'");
		@unlink("./graphic/player/".$user['image']);
		$user['image'] = '';
	}
	if(!empty($_FILES['image']['name'])){
	    $image = $_FILES['image'];
		$valid_types = array('image/jpeg','image/pjpeg','image/png','image/gif');
		if(empty($error) && !in_array($image['type'],$valid_types)){
			$error = "Desculpe más só são permitidas formatos JPEG, JPG, PNG ou GIF!";
		}
		if(empty($error) && $image['size'] > 614400/*122880*/){
			$error = "Desculpe, más o brasão não pode exeder 600kByte!";
		}
		$size_coords = getimagesize($image['tmp_name']);
		if(empty($error) && ($size_coords[0] > 500 && $size_coords[1] > 250)){
			$error = "Desculpe, más a imagem não pode ser maior que 500x250px!";
			/*240x180px*/
		}
		if(empty($error)){
			if(!empty($user['image'])){
			    $db->query("UPDATE `users` SET `image`='' WHERE `id`='".$user['id']."'");
				@unlink("./graphic/player/".$user['image']);
			}
		    $filename = $user['id'];
			$rand = rand(1,9999999);
			if($image['type'] == 'image/jpeg' || $image['type'] == 'image/pjpeg'){
				copy($image['tmp_name'], 'graphic/player/'.$filename.'-'.$rand.'.jpeg');
				$file = $filename.'-'.$rand.'.jpeg';
			}
			if($image['type'] == 'image/png'){
				copy($image['tmp_name'], 'graphic/player/'.$filename.'-'.$rand.'.png');
				$file = $filename.'-'.$rand.'.png';
			}
			if($image['type'] == 'image/gif'){
				copy($image['tmp_name'], 'graphic/player/'.$filename.'-'.$rand.'.gif');
				$file = $filename.'-'.$rand.'.gif';
			}
			$db->query("UPDATE `users` SET `image`='".$file."' WHERE `id`='".$user['id']."'");
		}
	}
	if(empty($error)){
		$db->query("UPDATE `users` SET `b_day`='".$day."',`b_month`='".$month."',`b_year`='".$year."',`sex`='".$geschlecht."',`home`='".$wohnort."' WHERE `id`='".$user['id']."'");
		header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=profile");
		$c->open();
		exit;
	}
	$c->open();	
}
if(isset($_GET['action']) && $_GET['action'] == 'change_text'){
	$c = new do_action($user['id']);
	$c->close();

	if(@$session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(empty($error) && strlen(@$_POST['personal_text']) > 10000){
		$error = "Desculpe, más você não pode exeder 10000 caracteres!";
	}
	if(empty($error)){
		$text = parse(@$_POST['personal_text']);
		$db->query("UPDATE `users` SET `personal_text`='".$text."' WHERE `id`='".$user['id']."'");
		header("LOCATION: game.php?village=".$village['id']."&screen=settings&mode=profile");
		$c->open();
		exit;
	}
	$c->open();	
}
$result = $db->query("SELECT `b_day`,`b_month`,`b_year`,`sex`,`home`,`image`,`personal_text` FROM `users` WHERE `id`='".$user['id']."'");
$profile = $db->fetch($result);

$profile['b_day'] = (int)$profile['b_day'];
if($profile['b_day'] < 1 || $profile['b_day'] > 31){
	$profile['b_day'] = '00';
}
$profile['b_year'] = (int)$profile['b_year'];
if($profile['b_year'] < 1){
	$profile['b_year'] = '0000';
}
$profile['home'] = entparse($profile['home']);
$profile['personal_text'] = "\n".entparse($profile['personal_text']);

$tpl->assign("profile",$profile);
?>
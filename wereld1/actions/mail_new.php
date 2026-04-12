<?php
if($ACTIONS_MASSIVKEY_HIGHAAASSDD!='sdjahsdkJHSAJDKHALKJHSADJHSADNsjdhaksjdlhJNASDKL'){
	exit;
}

$inputs = array();

$preview = false;

if(isset($_GET['action']) && $_GET['action'] == 'send'){
	if($session['hkey'] != $_GET['h']){
		$error = "Desculpe, más o código de segurança está invalido!";
	}
	if(empty($error) && strlen($_POST['subject']) < 2){
		$error = "Betreff muss mindestens zwei Zeichen lang sein!";
	}
	if(empty($error) && strlen($_POST['text']) < 3){
		$error = "Text muss mindestens drei Zeichen lang sein!";
	}
	if(empty($error) && strlen($_POST['text']) > 5000){
		$error = "Maximale Textl�nge 5000 Zeichen";
	}
	if(!empty($_GET['answer_mail_id']) && $_GET['answer_mail_id'] != 0){
		$result = $db->query("SELECT `to_id` FROM `mail_in` WHERE `id`='".parse($_GET['answer_mail_id'])."'");
		$mail = $db->fetch($result);
		if($user['id'] != $mail['to_id']){
			exit("Darfst das nicht...");
		}
	}
	if(!isset($_POST['to'])){
		$_POST['to'] = "";
	}
	$tos = explode(";",$_POST['to']);
	$count = 0;
	$send_to = array();
	foreach($tos as $to){
		if(!empty($to)){
			$count++;
			$to = parse($to);
			$res = $db->query("SELECT COUNT(`id`) AS `count`,`id`,`username` FROM `users` WHERE `username`='".$to."' GROUP BY `id`,`username`");
			$count_user = $db->fetch($res);
			if($count_user['count'] == 0){
				$error = "Empf�nger ".entparse($to)." nicht vorhanden.";
			}else{
				$res_bl = $db->query("SELECT COUNT(`id`) AS `count` FROM `mail_block` WHERE `userid`='".$count_user['id']."' AND `blocked_id`='".$user['id']."'");
				$check_bl = $db->Fetch($res_bl);
				if(empty($error) && $check_bl['count'] == 1){
					$error = entparse($to)." hat dich blockiert.";
				}else{
					if(!in_array($count_user['username'].";".$count_user['id'],$send_to)){
						$send_to[] = $count_user['username'].";".$count_user['id'];
					}
				}
			}
		}
	}
	if(empty($error) && $count < 1){
		$error = "Du musst mindestens einen Empf�nger angeben.";
	}
	if(isset($_POST['send'])){
		if(empty($error)){
			$subject = parse($_POST['subject']);
			$text = parse($_POST['text']);
			foreach($send_to as $userdata){
				$to_user = explode(";",$userdata);
				send_mail($user['id'],$user['username'],$to_user[1],$to_user[0],$subject,$text,true);
			}
			if(!empty($_GET['answer_mail_id']) && $_GET['answer_mail_id'] != 0){
				$db->query("UPDATE `mail_in` SET `is_answered`='1' WHERE `id`='".((int)parse($_GET['answer_mail_id']))."'");
			}
			header("LOCATION: game.php?village=".$village['id']."&screen=mail");
		}
	}
	if(isset($_POST['preview'])){
		if(empty($error)){
			$preview = true;
			$preview_message = nl2br(htmlspecialchars($_POST['text']));
			$tpl->assign("preview_message",$preview_message);
		}
	}
	$inputs['to'] = htmlspecialchars($_POST['to']);
	$inputs['subject'] = htmlspecialchars($_POST['subject']);
	$inputs['text'] = "\n".htmlspecialchars($_POST['text']);
}
if(!isset($_GET['action']) && isset($_GET['reply'])){
	$reply = parse((int)@$_GET['reply']);
	$error = "";

	if(empty($_GET['type'])){
		$result = $db->query("SELECT `to_id`,`subject`,`from_username`,`text` FROM `mail_in` WHERE `id`='".$reply."'");
		$mail = $db->fetch($result);
		if($user['id'] != $mail['to_id']){
			$inputs['to'] = "Keine Berechtigung";
			$inputs['subject'] = "Keine Berechtigung";
			$inputs['text'] = "--- Keine Berechtigung ---";
		}else{
			if(isset($_GET['forward'])){
				$inputs['to'] = '';
				$inputs['subject'] = "Fw: ".entparse($mail['subject']);
			}else{
				$inputs['to'] = entparse($mail['from_username']);
				$inputs['subject'] = "Re: ".entparse($mail['subject']);
			}
			$inputs['text'] = "\n\n\n".entparse($mail['from_username'])." schrieb:\n-->\n".nl2br(entparse($mail['text']));
		}
	}elseif($_GET['type'] == 'out'){
		$result = $db->query("SELECT `from_id`,`subject`,`to_username`,`from_username`,`text` FROM `mail_out` WHERE `id`='".$reply."'");
		$mail = $db->fetch($result);
		if($user['id'] != $mail['from_id']){
			$inputs['to'] = "Keine Berechtigung";
			$inputs['subject'] = "Keine Berechtigung";
			$inputs['text'] = "--- Keine Berechtigung ---";
		}else{
			if(isset($_GET['forward'])){
				$inputs['to'] = '';
				$inputs['subject'] = "Fw: ".entparse($mail['subject']);
			}else{
				$inputs['to'] = entparse($mail['to_username']);
				$inputs['subject'] = "Re: ".entparse($mail['subject']);
			}
			$inputs['text'] = "\n\n\n".entparse($mail['from_username'])." schrieb:\n-->\n".nl2br(entparse($mail['text']));
		}	
	}elseif ($_GET['type'] == 'arch'){
		$result = $db->query("SELECT `type`,`owner`,`from_id`,`subject`,`to_username`,`from_username`,`text` FROM `mail_archiv` WHERE `id`='".$reply."'");
		$mail = $db->fetch($result);
		if($user['id']!=$mail['owner']){
			$inputs['to'] = "Keine Berechtigung";
			$inputs['subject'] = "Keine Berechtigung";
			$inputs['text'] = "--- Keine Berechtigung ---";
		}else{
			if(isset($_GET['forward'])){
				$inputs['to'] = '';
				$inputs['subject'] = "Fw: ".entparse($mail['subject']);
				$inputs['text'] = "\n\n\n".entparse($mail['from_username'])." schrieb:\n-->\n".nl2br(entparse($mail['text']));
			}else{
				if($mail['type'] == 'in'){
					$inputs['to'] = entparse($mail['from_username']);
					$inputs['text'] = "\n\n\n".entparse($mail['from_username'])." schrieb:\n-->\n".nl2br(entparse($mail['text']));
				}else{
					$inputs['to'] = entparse($mail['to_username']);
					$inputs['text'] = "\n\n\n".entparse($mail['to_username'])." schrieb:\n-->\n".nl2br(entparse($mail['text']));
				}
				$inputs['subject'] = "Re: ".entparse($mail['subject']);
			}
		}	
	}
}
if(isset($_GET['player'])){
	$res = $db->query("SELECT `username` FROM `users` WHERE `id`='".((int)parse(@$_GET['player']))."'");
	$row = $db->fetch($res);
	$inputs['to'] = entparse($row['username']);
}
if(!empty($inputs['text'])){
	$inputs['text'] =str_replace("<br />","", $inputs['text']);
}

$tpl->assign("error",@$error);
$tpl->assign("view",@(int)$_GET['reply']);
$tpl->assign("inputs",@$inputs);
$tpl->assign("preview",$preview);
?>
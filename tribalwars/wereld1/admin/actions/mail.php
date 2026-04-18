<?php
$is_send = false;
$subject = "";
$text = "";
$error = "";
if(isset($_GET['action']) && $_GET['action'] == "send"){
	if(empty($_POST['subject'])){
		$error = "Keinen Betreff angegeben!";
	}
	if(empty($_POST['text'])){
		$error = "Keinen Text angegeben!";
	}
	if(empty($error)){
		$result = $db->query("SELECT `id`,`username` FROM `users`");
		while($row = $db->fetch($result)){
			send_mail(-1, "System", $row['id'], $row['username'], parse($_POST['subject']), parse($_POST['text']), false);
		}
		$is_send = true;
	}
	$subject = $_POST['subject'];
	$text = $_POST['text'];
}
$tpl->assign("is_send", $is_send);
$tpl->assign("error", $error);
$tpl->assign("subject", $subject);
$tpl->assign("text", $text);
?>
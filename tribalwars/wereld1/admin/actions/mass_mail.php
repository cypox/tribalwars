<?php
$subject = urlencode($_POST['subject']);
$message = urlencode($_POST['message']);
$from = urlencode('Paladini.Ro');
$time = time();

if($_GET['action'] == 'send'){
	if(strlen($_POST[subject]) < 4){	
		$error = "Subiectul trebuie sa contina cel putin 4 caractere!"; 
	}
	if (strlen($_POST[message]) < 15){ 	
		$error = "Mesajul trebuie sa contina cel putin 15 caractere!"; 	
	}
	if (!$error){
		$select_users = $db->query("SELECT * FROM users");
		while($row = $db->fetch($select_users)){
			$id = $row['id'];
			$username = $row['username'];
			$insert = "INSERT INTO mail (`from_userid`,`from_username`,`to_userid`,`to_username`,`title`,`message`,`time`,`from_read`) VALUES ('-1','".$from."','".$id."','".$username."','".$subject."','".$message."','".$time."','0')";
			$db->query($insert) or die (mysqli_error($db->get_connection()));
			$succes = "MEsajul a fost trimis cu succes!";
		}
		$db->query("UPDATE users SET new_mail = '1'") or die (mysqli_error($db->get_connection()));
	}
	$tpl->assign('succes', $succes);
	$tpl->assign('error', $error);
}
?>

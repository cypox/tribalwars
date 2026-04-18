<?php
 #########################################
 ### Desenvolvido por: Caique Portella ###
 ###  Email: caiqueportella@gmail.com  ###
 ########  Skype: caique-portela  ########
 ## MSN: caiqueportella@hotmail.com.br  ##
 #########################################
 
require ('../include.inc.php');
require('top.php');

$session = $_COOKIE['session'];
$select = $db->query("SELECT * FROM users WHERE support_session = '$session'");
$selected = $db->fetch($select);
$select_admin = $selected['administration'];
$select_row = $db->numrows($select);

if ($select_row == '1') {
	if ($select_admin != '1') {
		header ("Location: admin/");
	} else {
		header ("Location: playerticket.php");
	}
}

if (isset($_GET['action']) && $_GET['action'] == 'login') {
	$name = $_POST['name'];
	$password = md5(crc32(md5(sha1(md5($_POST['password'])))));

	$select_user = $db->query("SELECT * FROM users WHERE username = '$name'");
	$username = $db->numrows($select_user);
	$select_login = $db->query("SELECT * FROM users WHERE username = '$name' AND password = '$password'");
	$login = $db->numrows($select_login);

	if ($login == '1') { 
		$error = '';
		$session1 = cod(80);
		$session2 = cod(80);
		$session = $session1."-".$session2;
		setcookie("session", $session, time()+60*60*24*365);
		$db = $db->query("UPDATE users SET support_session = '$session' WHERE username = '$name'");
		header("Location: playerticket.php");
	}
}

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link rel="shortcut icon" href="files/images/player/favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1" />
		<title><?php echo $Global_header; ?></title>
			<link rel="stylesheet" type="text/css" href="files/styles/bootstrap.min.css" />
			<link rel="stylesheet" type="text/css" href="files/styles/player.new.css" />
			<script src="files/js/player.js" type="text/javascript"></script>
			<script src="files/js/swfobject.js" type="text/javascript"></script>
			<script src="files/js/jquery.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="container">

			<div id="header">
				<h1><?php echo $Global_header; ?><img src="files/images/new/logo.png" alt="" style="float: right" /></h1>
			</div>
			<div id="sep"></div>
			<div id="content">

				<h2><?php echo $Index_login   ?></h2>
				<div style="float: right; margin: 20px">
					<div id="logo"><img style="max-width: 350px; height: auto" src="files/images/player/games/staemme.png" alt=""></div>
				</div>

				<div style="float: left">
					<form class="form-horizontal" action="?action=login" method="post">
						<div class="control-group <?php if (isset($_GET['action']) && $username != '1') { echo "error"; } ?>">
							<label style="width: 100px" class="control-label" for="inputName"><?php echo $Index_input_name; ?>:</label>
							<div style="margin-left: 120px" class="controls">
								<input type="text" name="name" id="inputName" placeholder="<?php echo $Index_input_name; ?>" style="width: 150px" >
								<?php 	if (isset($_GET['action']) && $username != '1') {  ?>
									<span class="help-inline"><?php echo $Index_error_username;  ?>.</span>
								<?php } ?>
							</div>
						</div>
						<div class="control-group <?php if (isset($_GET['action']) && $username == '1' && $login != '1') { echo "error"; } ?>">
							<label style="width: 100px" class="control-label" for="inputPassword"><?php echo $Index_input_password; ?>:</label>
							<div style="margin-left: 120px" class="controls">
								<input type="password" name="password" id="inputPassword" placeholder="<?php echo $Index_input_password; ?>" style="width: 150px">
								<?php 	if (isset($_GET['action']) && $username == '1' &&$login != '1') {  ?>
									<span class="help-inline"><?php echo $Index_error_login;  ?>.</span>
								<?php } ?>
							</div>
						</div>
						<div class="control-group">
							<div style="margin-left: 120px" class="controls">
								<button class="btn btn-success"><?php echo $Index_button;  ?></button>
							</div>
						</div>
					</form>
				</div>

				<div style="clear: both"></div>
				<br /><br />
				<div>
					<h2 id="submit"><?php echo $Global_config; ?></h2>
		
					<form class="form" action="?action=config" method="post">
						<label><?php echo $Global_language; ?></label>
						<select name="lang" style="width: 180px">
							<option value="0"><?php echo $Global_option_0; ?></option>
							<option value="1"><?php echo $Global_option_pt; ?></option>
							<option value="2"><?php echo $Global_option_en; ?></option>
						</select>
						<br />
						<button type="submit" class="btn btn-success"><?php echo $Global_value_config; ?></button>
					</form>
				</div>
			</div>

		</div>
		<div id="footer">
			<div>
				&copy; <?php echo $config['ano']; ?> - <?php echo date("Y"); ?> 
				<?php for ($x = 1; $x <= 10; $x++) {
					if (isset($config["footer_$x"]) && $config["footer_$x"] != "") { echo $config["footer_$x"]; }
					if (!isset($config["footer_$x"])) { break; }
				}
				?>
			</div>
		</div>
	</body>
</html>
<?php
 #########################################
 ### Desenvolvido por: Caique Portella ###
 ###  Email: caiqueportella@gmail.com  ###
 ########  Skype: caique-portela  ########
 ## MSN: caiqueportella@hotmail.com.br  ##
 #########################################
 
require ('../../include.inc.php');
require('top.php');

$session = $_COOKIE['session'];
$select = $db->query("SELECT * FROM users WHERE support_session = '$session'");
$selected = $db->fetch($select);
$select_user = $selected['username'];
$select_row = $db->numrows($select);

if ($select_row == '0') {
	header ("Location: Sid_wrong.php");
}

if ($selected['administration'] == '1') {
	header ("Location: ../");
}

if (isset($_GET['screen'])) {
	$screen = $_GET['screen'];
} else {
	$screen = 'home';
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
	$db = $db->query("UPDATE users SET support_session = '' WHERE username = '$select_user'");
	setcookie("session", "", time()+60*60*24*365);
	header("Location: logout.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link rel="shortcut icon" href="../files/images/player/favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1" />
		<title><?php echo $titulo ?> | Administração</title>
		<link rel="stylesheet" type="text/css" href="../files/styles/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="../files/styles/player.new.css" />
		<script src="../files/js/player.js" type="text/javascript"></script>
		<script src="../files/js/swfobject.js" type="text/javascript"></script>
		<script src="../files/js/jquery.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1>Administração | Suporte <img src="../files/images/new/logo.png" alt="" style="float: right" /></h1>
			</div>
			<div id="sep"></div>
			<div id="content">
				<div class="navbar">
					<div class="navbar-inner">
						<div class="container">
							<div class="nav-collapse collapse">
								<ul class="nav">
									<li class="<?php if ($screen  == 'home') { echo 'active'; } ?>">
										<a href="?screen=home">Home</a>
									</li>
									<li class="<?php if ($screen == 'ticket_open') { echo 'active'; } ?>">
										<a href="?screen=ticket_open">Tickets Abertos</a>
									</li>
									<li class="<?php if ($screen  == 'ticket_closed') { echo 'active'; } ?>">
										<a href="?screen=ticket_closed">Tickets Fechados</a>
									</li>
									<li class="<?php if ($screen  == 'manage_users') { echo 'active'; } ?>">
										<a href="?screen=manage_users">Gerenciar Usuários</a>
									</li>
								</ul>
								</div>
							</div>
						</div>
					</div>
				<?php
					require ("$screen.php");
				?>
								<a class="btn btn-danger" href="?action=logout">Logout</a>
								<br /><br />
								
<script type="text/javascript">
	$(document).ready(function() {
		Support.Ticket.init();
	});
</script>

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
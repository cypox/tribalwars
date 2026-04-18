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
$select_row = $db->numrows($select);

$selected = $db->fetch($select);
if ($selected['administration'] != '1') {
	header ("Location: admin/");
}

if ($select_row == '0') {
	header ("Location: Sid_wrong.php");
}


if (isset($_GET['action']) && $_GET['action'] == 'insert') {
	$title = $_POST['subject'];
	$text = $_POST['text'];
	$type = $_GET['type_id'];
	$world = $_GET['world_id'];
	$data = date("d-m-Y H:i:s");
	$session = $_COOKIE['session'];
	$id = $selected['id'];
	if (strlen($title) < '8') {
		
	} else if (strlen($text) < '8') {
	
	} else {
		$insert = $db->query("INSERT INTO support_ticket (user_id, world, type, title, text, date, status, last_response) VALUES ('$id', '$world', '$type', '$title', '$text', '$data', 'open', '$data')");
		header ("Location: playerticket.php?success");
	}
}
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link rel="shortcut icon" href="files/images/player/favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1" />
		<title><?php echo $titulo ?></title>
			<link rel="stylesheet" type="text/css" href="files/styles/bootstrap.min.css" />
			<link rel="stylesheet" type="text/css" href="files/styles/player.new.css" />
			<script src="files/js/player.js" type="text/javascript"></script>
			<script src="files/js/swfobject.js" type="text/javascript"></script>
			<script src="files/js/jquery.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1><?php echo $nome ?> Suporte		<img src="files/images/new/logo.png" alt="" style="float: right" /></h1>
			</div>
			<div id="sep"></div>
			<div id="content">
	

				<h2>Criar novo ticket</h2>



				<div class="span8">
					<form class="form-horizontal" id="submit_form" action="?action=insert&amp;type_id=<?php if (isset($_POST['type_id'])) { echo $_POST['type_id']; } else { echo $_GET['type_id']; } ?>&amp;world_id=<?php if (isset($_POST['world_id'])) { echo $_POST['world_id']; } else { echo $_GET['world_id']; } ?>" method="post">
						<input type="hidden" name="fv" id="fv" value="" />
						<div id="subject_group" class="control-group <?php if (isset($_GET['action']) && strlen($title) < '8') { echo "error"; } ?>">
							<label>Título</label>
							<input name="subject" style="width: 400px" type="text" id="inputTitle" placeholder="Um breve resumo do ticket" value="<?php if (isset($_GET['action']) && strlen($title) >= '8') { echo $title; } ?>">
							<?php if (isset($_GET['action']) && strlen($title) != '1') { ?>
							<span class="help-inline">O assunto deve ter pelo menos 8 caracteres.</span>
							<?php } ?>
						</div>
						<div style="width: 400px">
							<div id="message_group" class="control-group <?php if (isset($_GET['action']) && strlen($text) < '8') { echo "error"; } ?>">
								<div style="margin-top: 5px; height: 24px">
									<a title="Negrito" href="javascript: insertBBcode('message', '[b]', '[/b]');">
										<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat 0px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px"></div>
									</a>
									<a title="Italico" href="javascript: insertBBcode('message', '[i]', '[/i]');">
										<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -20px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px"></div>
									</a>
									<a title="Sublinhado" href="javascript: insertBBcode('message', '[u]', '[/u]');">
										<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -40px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px"></div>
									</a>
									<a title="Atacar" href="javascript: insertBBcode('message', '[s]', '[/s]');">
										<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -60px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px"></div>
									</a>
									<a title="Quote" href="javascript: insertBBcode('message', '[quote]', '[/quote]');">
										<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -80px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px"></div>
									</a>
									<a title="Link" href="javascript: insertBBcode('message', '[url=]', '[/url]');">
										<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -100px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px"></div>
									</a>
									<a title="Code" href="javascript: insertBBcode('message', '[code]', '[/code]');">
										<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -120px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px"></div>
									</a>
								<a title="?	add comment	fuzzy Imagem" href="javascript: insertBBcode('message', '[img]', '[/img]');">
									<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -140px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px"></div>
								</a>
					
								</div>
								<textarea style="clear: both; width: 100%; height: 200px; margin-bottom: 10px" id="message" name="text"><?php if (isset($_GET['action']) && strlen($text) >= '8') { echo $text; } ?></textarea>
								<?php if (isset($_GET['action']) && strlen($text) < '8') {  ?>
								<span class="help-inline">O texto deve ter de pelo menos 8 caracteres.</span>
								<?php } ?>
							</div>
	
							<div class="control-group" style="margin-bottom: 0">
								<button style="float: right" type="submit" id="submit" class="btn btn-success">Criar</button>
								<a href="playerticket.php" class="btn btn-danger">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
				<div class="clearfix"></div>
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
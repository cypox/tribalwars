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
$select_id = $selected['id'];
$select_user = $selected['username'];
$select_admin = $selected['administration'];
$select_row = $db->numrows($select);

if ($select_admin != '1') {
	header ("Location: admin/");
}

if ($select_row == '0') {
	header ("Location: Sid_wrong.php");
}

$ticket = $db->query("SELECT * FROM support_ticket ORDER BY id ASC");

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
	$db = $db->query("UPDATE users SET support_session = '' WHERE username = '$select_user'");
	setcookie("session", "", time()+60*60*24*365);
	header("Location: logout.php");
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
			<?php if (isset($_GET['success'])) { ?>
				<h2>Ticket criado com sucesso</h2>
				<p>Seu ticket foi criado e será respondido por um membro de nossa equipe de suporte o mais breve possível. Quando você receber uma resposta, você será notificado por e-mail e, se possível no jogo. Por favor, esteja ciente de que os tickets são geralmente respondidas na ordem que recebemos, mas, se responder seu próprio ticket antes de nós, ele irá cair na fila do recebimento e será o último novamente.</p>
				<a class="btn btn-danger" href="playerticket.php">Retornar à listagem </a>
			<?php } else { ?>
			<div class="row">
				<div class="span9">
					<h2><?php echo $select_user ?>'s tickets</h2>
		
					<p>Aqui você pode ver uma lista de seus tickets de suporte, abertos e resolvidos.</p>
		
					<table class="table table-striped table-bordered">
						<tr>
							<th style="width: 43%">Título</th>
							<th style="width: 17%">Mundo</th>
							<th style="width: 20%">Última resposta</th>
							<th style="width: 20%">Status</th>
						</tr>
						<?php
							while ($array = $db->fetch($ticket)) {	
								if ($array['user_id'] == $select_id) {
								
									$world = $db->query("SELECT * FROM worlds WHERE id = '".$array['world']."'"); 
									$world = $db->fetch($world);
																	
									if ($array['status'] == 'open') {
										$status = '<img src="files/images/player/solved.png" alt="" /> Aberto';
									} else if ($array['status'] == 'resolved') {
										$status = '<img src="files/images/player/solved.png" alt="" /> Resolvido';
									} else if ($array['status'] == 'Answer') {
										$status = '<img src="files/images/player/solved.png" alt="" /> Respondido';
									} else if ($array['status'] == 'closed') {
										$status = '<img src="files/images/player/solved.png" alt="" /> Fechado';
									} 									
									echo '<tr>';
										echo '<td><a href="showticket.php?ticketID='.$array['id'].'">'.$array['title'].'</a></td>';
										echo '<td>'.$world['name'].'</td>';
										echo '<td>'.$array['last_response'].'</td>';
										echo '<td>'.$status.'</td>';
									echo '</tr>';
								}
							}
						?>
				
					</table>
				</div>
				<div class="span3">
					<h2 id="submit">Criar novo ticket</h2>
		
					<form class="form" action="verify.php" method="post">
						<label>Mundo:</label>
						<select name="world_id" style="width: 180px">
							<option value="0">Selecionar...</option>
							<?php
								$world = $db->query("SELECT * FROM worlds ORDER BY id ASC");
								while ($array = $db->fetch($world)) {	
									if ($array['active'] == '1') {
										echo '<option value="'.$array['id'].'">'.$array['name'].'</option>';
									}
								}
							?>
						</select>
						<label>Tipo:</label>
						<select id="select_type" name="type_id" style="width: 180px">
							<option value="0">Selecionar...</option>
							<option value="1" >Bugs/erros</option>
							<option value="2" >Conta premium</option>
							<option value="3" >Fórum</option>
							<option value="4" >Infração de regras</option>
							<option value="5" >Outros</option>
							<option value="6" >Perguntas</option>
							<option value="7" >Problemas de acesso</option>
							<option value="8" >Protesto contra bloqueio</option>
						</select>
						<button type="submit" class="btn btn-success">Submeter</button>
					</form>
				</div>
			</div>
				<a class="btn btn-danger" href="?action=logout">Logout</a>
				<br /><br /><br />
				
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
				<?php } ?>
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

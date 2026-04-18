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
$select = $db->query("SELECT id,username,administration FROM users WHERE support_session = '$session'");
$select_row = $db->numrows($select);

$selected = $db->fetch($select);
if ($selected['administration'] != '1') {
	header ("Location: admin/");
}

if ($select_row == '0') {
	header ("Location: Sid_wrong.php");
}

$world_id = $_POST['world_id'];
$type_id = $_POST['type_id'];

$word = $db->query("SELECT * FROM worlds WHERE id = '$world_id'");
$wordf = $db->fetch($word);
$world = $wordf['name'];
$wordn = $db->numrows($word);

if ($type_id == '1') {
	$type = "Bugs/erros";
	$description = "Bugs/erros";
} else if ($type_id == '2') {
	$type = "Conta premium";
	$description = "Conta premium";
} else if ($type_id == '3') {
	$type = "Fórum";
	$description = "Fórum";
} else if ($type_id == '4') {
	$type = "Infração de regras";
	$description = "Aqui poderá denunciar qualquer infração das regras do jogo.";
} else if ($type_id == '5') {
	$type = "Outros";
	$description = "Outros";
} else if ($type_id == '6') {
	$type = "Perguntas";
	$description = 'A maioria das perguntas podem ser feitas em nosso fórum, <a href="'.$forum.'" target="_blank">clicando aqui</a>. Diversos usuários experientes irão lhe ajudar no fórum e assim você evita sobrecarregar a equipe de suporte.';
} else if ($type_id == '7') {
	$type = "Problemas de acesso";
	$description = "Problemas de acesso";
} else if ($type_id == '8') {
	$type = "Protesto contra bloqueio";
	$description = "Apelo";
} else {
	$error = true;
}

if ($wordn == '0') {
	$error = true;
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
	
			<?php if (!$error) { ?>
				<h2>Por favor, verifique seus dados</h2>

				<p>Para responder a sua solicitação o mais rápido possível, certifique-se de que selecionou o mundo direito e tipo de ticket.</p>

				<p><strong>Mundo:</strong> <?php echo $world ?></p>
				<p><strong>Tipo:</strong> <?php echo $type ?></p>

				<p><?php echo $description ?></p>
				<p><a href="playerticket.php"> Alterar detalhes de ticket</a></p>
				
				<br />
				<form method="post" action="faq-text.php">
					<input type="hidden" name="world_id" value="<?php echo $world_id ?>"></input>
					<input type="hidden" name="type_id" value="<?php echo $type_id ?>"></input>
					<button type="submit" class="btn btn-success">Continuar</button>
				</form>
			<?php } else { ?>

				<h5>Por favor, selecione um tipo de ticket válido.</h5>

				<a href="javascript:history.back();">Voltar</a>
			
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
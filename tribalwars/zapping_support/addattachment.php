<?php
 #########################################
 ### Desenvolvido por: Caique Portella ###
 ###  Email: caiqueportella@gmail.com  ###
 ########  Skype: caique-portela  ########
 ## MSN: caiqueportella@hotmail.com.br  ##
 #########################################
 
require ('../include.inc.php');
require('top.php');


$id = $_GET['ticketID'];

$user = $db->query("SELECT * FROM support_ticket WHERE id = '$id'");
$user = $db->fetch($user);
$user_id = $db->query("SELECT * FROM users WHERE id = '".$user['user_id']."'");
$user_id = $db->fetch($user_id);
$user_id = $user_id['id'];

			
if (isset($_GET['action']) && $_GET['action'] == 'upload') {
	// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
	if ($_FILES['attachment']['error'] != 0) {
		$error = ("Não foi possível fazer o upload, erro:<br />" . $Add_Attachment_upload['erros'][$_FILES['attachment']['error']]);
		exit; // Para a execução do script
	}

	// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

	// Faz a verificação da extensão do arquivo
	$extensao = strtolower(end(explode('.', $_FILES['attachment']['name'])));
	if (array_search($extensao, $upload['extension']) === false) {
		$error = "O tipo de arquivo enviado não é suportado atualmente. Tipos de arquivo aceitos são: .jpg, .png, .fig, .jpeg.";
	}

	// Faz a verificação do tamanho do arquivo
	else if ($upload['size'] < $_FILES['attachment']['size']) {
		$error = "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
	}

	// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
	else {
		// Primeiro verifica se deve trocar o nome do arquivo
		if ($upload['rename'] == true) {
			// Cria um nome pré-definido.
			$date = date("d.m.Y");
			$hour = date("H.i.s");
			$nome_final = "upload_User-".$user_id."_".$date."_".$hour.".".$extensao."";
		} else {
			// Mantém o nome original do arquivo
			$nome_final = $_FILES['attachment']['name'];
		}	

		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['attachment']['tmp_name'], $upload['file'] . $nome_final)) {
			// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
			//$error = "Upload efetuado com sucesso!";
			//echo '<br /><a href="' . $upload['file'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
			$data = date("d-m-Y");
			$hour = date("H:i:s");
			$insert = $db->query("INSERT INTO support_upload (user_id, ticket_id, upload_name, name, date, hour, extension) VALUES ('$user_id', '$id', '$nome_final', '".$_FILES['attachment']['name']."', '$data', '$hour', '$extensao')");
	
			header ("Location: showticket.php?ticketID=$id");
		} else {
			// Não foi possível fazer o upload, provavelmente a pasta está incorreta
			$error = "Não foi possível enviar o arquivo, tente novamente";
		}

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
	
				<h5><?php echo $error; ?></h5>

				<a href="showticket.php?ticketID=<?php echo $id ?>">Voltar</a>
	
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
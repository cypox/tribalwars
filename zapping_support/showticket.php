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

$id = $_GET['ticketID'];
$session = $_COOKIE['session'];

if (isset($_GET['action']) && $_GET['action'] == 'status') {
	$update = $db->query("UPDATE support_ticket SET status = 'resolved' WHERE id = '$id'");
	header ("Location: showticket.php?ticketID=$id");
}

if (isset($_GET['action']) && $_GET['action'] == 'insert') {
	$text = $_POST['text'];
	$data = date("d-m-Y H:i:s");
	$select = $db->query("SELECT * FROM users WHERE support_session = '$session'");
	$selected = $db->fetch($select);
	$author = $selected['username'];
	$insert = $db->query("INSERT INTO support_response (ticket_id, date, author, response) VALUES ('$id', '$data', '$author', '$text')");
	$update = $db->query("UPDATE support_ticket SET status = 'open', last_response = '".$data."' WHERE id = '".$id."'");
	header ("Location: showticket.php?ticketID=$id");
}


$ticket = $db->query("SELECT * FROM support_ticket WHERE id = $id");
$ticket = $db->fetch($ticket);

if ($selected['administration'] == '1') { 
	$class = 'reply player';
} else { 
	$class = 'reply'; 
}

$response = $db->query("SELECT * FROM support_response ORDER BY id ASC");

$anexo = $db->query("SELECT * FROM support_upload WHERE ticket_id = '$id'");

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
				<div class="row">
		
					<div class="span8">
						<h2>Ticket: <?php echo $ticket['title'] ?></h2>
					
						<?php	if ($ticket['status'] == 'open' || $ticket['status'] == 'Answer') {?>					
							<div style="margin-bottom: 20px">
								<p>Se o seu problema foi resolvido, por favor, nos ajude, definindo o status para resolvido. Obrigado!</p>
								<a class="btn btn-success btn-small" href="showticket.php?ticketID=<?php echo $id ?>&amp;action=status">Meu problema foi resolvido</a>
							</div>
						<?php } ?>
						
						<?php						
					echo "<div class='reply player'>";
						echo '<h4>';
							echo $selected['username'];
							echo '<span>'.$ticket['date'].'</span>';
						echo '</h4>';
						echo '<div>';
						   $texto = htmlentities($ticket['text']); 
							$a = array( 
								"/\[i\](.*?)\[\/i\]/is", 
								"/\[b\](.*?)\[\/b\]/is", 
								"/\[u\](.*?)\[\/u\]/is", 
								"/\[s\](.*?)\[\/s\]/is", 
								"/\[quote\](.*?)\[\/quote\]/is", 
								"/\[code\](.*?)\[\/code\]/is", 
								"/\[img\](.*?)\[\/img\]/is", 
								"/\[url=(.*?)\](.*?)\[\/url\]/is" 
							); 
							$b = array( 
								"<i>$1</i>", 
								"<b>$1</b>", 
								"<u>$1</u>", 
								"<s>$1</s>", 
								"<div class='quote'><div class='quote_author'></div><div class='quote_content'>$1</div></div>", 
								"<pre>$1</pre>", 
								"<img src=\"$1\" />",
								"<a href=\"$1\" target=\"_blank\">$2</a>" 
							); 
							$texto = preg_replace($a, $b, $texto); 
							$texto = nl2br($texto); 
							echo $texto; 
						echo '</div>';
					echo '</div>';
		?>
<?php			
				while ($array = $db->fetch($response)) {	
					if ($array['ticket_id'] == $id) {						
						if ($array['author'] != $selected['username']) { 
							$class = 'reply';
						} else { 
							$class = 'reply player'; 
						}
						echo "<div class='$class'>";
							echo '<h4>';
								echo $array['author'];
								echo '<span>'.$array['date'].'</span>';
							echo '</h4>';
							echo '<div>';
								$texto = htmlentities($array['response']); 
								$a = array( 
									"/\[i\](.*?)\[\/i\]/is", 
									"/\[b\](.*?)\[\/b\]/is", 
									"/\[u\](.*?)\[\/u\]/is", 
									"/\[s\](.*?)\[\/s\]/is", 
									"/\[quote\](.*?)\[\/quote\]/is", 
									"/\[code\](.*?)\[\/code\]/is", 
									"/\[img\](.*?)\[\/img\]/is", 
									"/\[url=(.*?)\](.*?)\[\/url\]/is" 
								); 
								$b = array( 
									"<i>$1</i>", 
									"<b>$1</b>", 
									"<u>$1</u>", 
									"<s>$1</s>", 
									"<div class='quote'><div class='quote_author'></div><div class='quote_content'>$1</div></div>", 
									"<pre>$1</pre>", 
									"<img src=\"$1\" />",
									"<a href=\"$1\" target=\"_blank\">$2</a>" 
								); 
								$texto = preg_replace($a, $b, $texto); 
								$texto = nl2br($texto); 
								echo $texto; 
							echo '</div>';
						echo '</div>';
					}
				}
		?>
				</div>
			
<?php	if ($ticket['status'] != 'closed') { ?>
		<div class="span4">
				<h2>Anexos</h2>

				<?php 	if ($db->numrows($anexo) == '0') {  ?>
					Este ticket atualmente não tem anexos.<br /><br />
				<?php } else { ?>
					<table class="table">
						<?php 
							while ($array = $db->fetch($anexo)) {	
								echo "<tr>";
									echo "<td>";
										echo "<img src='files/images/attachments/mime_png.png' alt='' style='vertical-align:middle' /> ";
										echo "<a target='_blank' href='attachment.php?ticketID=$id&amp;attachment=".$array['upload_name']."'>".$array['name']."</a>";
									echo "</td>";
									echo "<td>";
										echo "<span style='float: right'>".$array['date']." ".$array['hour']."</span>";
									echo "</td>";
								echo "</tr>";
							}
						?>
				</table>
				<?php } ?>
				<a class="btn btn-success" href="#" id="upload_button">Carregar novo anexo</a>
		
		<div id="upload" style="display: none">
			<p>Aceito os seguintes tipos de arquivo: .jpg, .png, .bmp, .gif, .jpeg . Tamanho máximo do arquivo: 2Mb.</p>
			
			<form enctype="multipart/form-data" action="addattachment.php?action=upload&ticketID=<?php echo $id ?>" method="POST">
				<input name="attachment" type="file" />
				<input type="submit" value="Upload" />
			</form>
		</div>
		
		<hr />
		
		<?php 
		$responses = $db->query("SELECT * FROM support_response WHERE ticket_id = '$id'");
		$responses = "0";
		while($arrai = $db->fetch($responses)) {
			$response = $db->fetch($db->query("SELECT * FROM users WHERE username = '".$arrai['author']."'"));
			if ($response['administration'] != '1') {
				$responses++; 
			}
		}
		if ($responses != '0') {?>
		<div class="alert alert-info">
			Nós estamos sempre procurando maneiras de melhorar o nosso serviço de suporte. Por favor, dedique um pouco do seu tempo para opinar sobre seu atendimento.
		</div>
		
		<a style="float: right; margin-right: 20px" href="rate.php?ticketID=<?php echo $id ?>" class="btn btn-info btn-small">Dar feedback</a>
		<?php } ?>
		
			</div>
</div>


<h2><?php if ($ticket['status'] == 'resolved') { ?>Reabrir ticket<?php } else { ?>Responder<?php } ?></h2>
<form action="showticket.php?ticketID=<?php echo $id ?>&amp;action=insert" method="post" >
	<div style="height: 30px">
		<a title="Negrito" href="javascript: insertBBcode('message', '[b]', '[/b]');">
		<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat 0px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Italico" href="javascript: insertBBcode('message', '[i]', '[/i]');">
		<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -20px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Sublinhado" href="javascript: insertBBcode('message', '[u]', '[/u]');">
		<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -40px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Atacar" href="javascript: insertBBcode('message', '[s]', '[/s]');">
		<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -60px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Quote" href="javascript: insertBBcode('message', '[quote]', '[/quote]');">
		<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -80px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Link" href="javascript: insertBBcode('message', '[url=]', '[/url]');">
		<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -100px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Code" href="javascript: insertBBcode('message', '[code]', '[/code]');">
		<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -120px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="?

 add comment
 fuzzy 

Imagem" href="javascript: insertBBcode('message', '[img]', '[/img]');">
		<div style="float: left; background:url(files/images/player/bbcodes.png) no-repeat -140px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		</div>
	<textarea style="clear: both; width: 400px; height: 200px" id="message" name="text"></textarea>
	<br />
	<button id="reply" type="submit" class="btn btn-success" >Enviar resposta</button>
</form>	

<?php 
} else if ($ticket['status'] == 'closed') { 
?>

	<div class="span4">
				
			</div>
</div>
<p>Este ticket foi fechado e não pode mais ser respondido.</p>
<?php } ?>

<br />
<a class="btn btn-danger btn-small" href="playerticket.php">Retornar à listagem </a>

<script type="text/javascript">
	$(document).ready(function() {
		Support.Ticket.init();
	});
</script>

<div class="clearfix"></div>

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
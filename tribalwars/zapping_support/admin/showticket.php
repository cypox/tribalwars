<?php
 #########################################
 ### Desenvolvido por: Caique Portella ###
 ###  Email: caiqueportella@gmail.com  ###
 ########  Skype: caique-portela  ########
 ## MSN: caiqueportella@hotmail.com.br  ##
 #########################################
 
$id = $_GET['ticketID'];
$session = $_COOKIE['session'];

$ticket = $db->query("SELECT * FROM support_ticket WHERE id = $id");
$ticket = $db->fetch($ticket);

if (isset($_GET['action']) && $_GET['action'] == 'status') {
	$status = $_GET['status'];
	$update = $db->query("UPDATE support_ticket SET status = '$status' WHERE id = '$id'");
	header ("Location: ?screen=showticket&ticketID=$id");
}

if (isset($_GET['action']) && $_GET['action'] == 'insert') {
	$text = $_POST['text'];
	$data = date("d-m-Y H:i:s");
	$select = $db->query("SELECT * FROM users WHERE support_session = '$session'");
	$selected = $db->fetch($select);
	$author = $selected['username'];
	$insert = $db->query("INSERT INTO support_response (ticket_id, date, author, response) VALUES ('$id', '$data', '$author', '$text')");
	if ($ticket['status'] == 'closed') {
		$update = $db->query("UPDATE support_ticket SET last_response = '".$data."' WHERE id = '".$id."'");
	} else {
		$update = $db->query("UPDATE support_ticket SET status = 'Answer', last_response = '".$data."' WHERE id = '".$id."'");
	}
	header ("Location: ?screen=showticket&ticketID=$id");
}

$user = $db->query("SELECT * FROM users WHERE id = '".$ticket['user_id']."'");
$user = $db->fetch($user);

$response = $db->query("SELECT * FROM support_response ORDER BY id ASC");

$anexo = $db->query("SELECT * FROM support_upload WHERE ticket_id = '$id'");

?>
				<div class="row">
		
					<div class="span8">
						<h2>Ticket: <?php echo $ticket['title'] ?></h2>
					
								<?php 
									if ($ticket['status'] != 'closed') { 
								?>			
							<div style="margin-bottom: 20px">
								<p>Se o problema foi resolvido, por favor, feche o ticket.</p>
								<a class="btn btn-success btn-small" href="?screen=showticket&ticketID=<?php echo $id ?>&amp;action=status&amp;status=closed">O problema foi resolvido</a>
							</div>
								<?php 
									} else { 
								?>	
							<div style="margin-bottom: 20px">
								<p>Se o problema não foi resolvido corretamente, por favor, reabra o ticket.</p>
								<a class="btn btn-danger btn-small" href="?screen=showticket&ticketID=<?php echo $id ?>&amp;action=status&amp;status=open">Reabri-lo</a>
							</div>						
						
								<?php 
									} 
								?>	
						<?php						
					echo "<div class='reply player'>";
						echo '<h4>';
							echo $user['username'];
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
					if ($array['ticket_id'] == $ticket['id']) {
						$admin = $db->query("SELECT * FROM users WHERE username = '".$array['author']."'");
						$admin =$db->fetch($admin);
						
						if ($admin['admin'] == '1') { 
							$class = 'reply player';
						} else { 
							$class = 'reply'; 
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
										echo "<img src='../files/images/attachments/mime_png.png' alt='' style='vertical-align:middle' /> ";
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
						
			</div>
</div>


<h2>Responder</h2>
<form action="?screen=showticket&amp;ticketID=<?php echo $id ?>&amp;action=insert" method="post" >
	<div style="height: 30px">
		<a title="Negrito" href="javascript: insertBBcode('message', '[b]', '[/b]');">
		<div style="float: left; background:url(../files/images/player/bbcodes.png) no-repeat 0px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Italico" href="javascript: insertBBcode('message', '[i]', '[/i]');">
		<div style="float: left; background:url(../files/images/player/bbcodes.png) no-repeat -20px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Sublinhado" href="javascript: insertBBcode('message', '[u]', '[/u]');">
		<div style="float: left; background:url(../files/images/player/bbcodes.png) no-repeat -40px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Atacar" href="javascript: insertBBcode('message', '[s]', '[/s]');">
		<div style="float: left; background:url(../files/images/player/bbcodes.png) no-repeat -60px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Quote" href="javascript: insertBBcode('message', '[quote]', '[/quote]');">
		<div style="float: left; background:url(../files/images/player/bbcodes.png) no-repeat -80px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Link" href="javascript: insertBBcode('message', '[url=]', '[/url]');">
		<div style="float: left; background:url(../files/images/player/bbcodes.png) no-repeat -100px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="Code" href="javascript: insertBBcode('message', '[code]', '[/code]');">
		<div style="float: left; background:url(../files/images/player/bbcodes.png) no-repeat -120px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		<a title="?

 add comment
 fuzzy 

Imagem" href="javascript: insertBBcode('message', '[img]', '[/img]');">
		<div style="float: left; background:url(../files/images/player/bbcodes.png) no-repeat -140px 0px; padding-left: 0px; padding-bottom:0px; margin-right: 4px; width: 20px; height: 20px; margin-top: 3px; margin-bottom: 3px;"></div>
	</a>
		</div>
	<textarea style="clear: both; width: 400px; height: 200px" id="message" name="text"></textarea>
	<br />
	<button id="reply" type="submit" class="btn btn-success" >Enviar resposta</button>
</form>	


<br />
<?php 
	if ($ticket['status'] != 'closed') { 
?>		
<a class="btn btn-danger btn-small" href="?screen=ticket_open">Retornar à listagem </a>
<?php
	} else {
?>
<a class="btn btn-danger btn-small" href="?screen=ticket_closed">Retornar à listagem </a>
<?php
	}
?>
<div class="clearfix"></div>
<br /><br /><br />
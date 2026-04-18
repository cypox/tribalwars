<?php
 #########################################
 ### Desenvolvido por: Caique Portella ###
 ###  Email: caiqueportella@gmail.com  ###
 ########  Skype: caique-portela  ########
 ## MSN: caiqueportella@hotmail.com.br  ##
 #########################################
 
$user = $db->query("SELECT * FROM users WHERE administration = '1'");
$users = $db->numrows($user);
 
$admin = $db->query("SELECT * FROM users WHERE administration != '1'");
$admins = $db->numrows($admin);

$ticket = $db->query("SELECT * FROM support_ticket");
$tickets = $db->numrows($ticket);

$ticket_open = $db->query("SELECT * FROM support_ticket WHERE status = 'open'");
$tickets_open = $db->numrows($ticket_open);

$ticket_closed = $db->query("SELECT * FROM support_ticket WHERE status = 'closed'");
$tickets_closed = $db->numrows($ticket_closed);

$response = $db->query("SELECT * FROM support_response");
$responses = $db->numrows($response);

$user = $db->fetch($user);
$admin = $db->fetch($admin);
$response_user = 0;
$response_admin = 0;

while ($array = $db->fetch($response)) {
	if ($user['username'] == $array['author']) {
		$response_user = $response_user+1;
	} else if ($admin['username'] == $array['author']) {
		$response_admin = $response_admin+1;
	}
}

$anexos = $db->query("SELECT * FROM support_upload");
$anexos = $db->numrows($anexos);


?>
<h2 id="submit">Informações do suporte:</h2>
<br /><br />
<p><b>Usuários:</b> <?php echo $users; ?></p>
<p><b>Administradores:</b> <?php echo $admins; ?></p>
<p><b>Tickets:</b> <?php echo $tickets; ?></p>
<p><b>Tickets Abertos:</b> <?php echo $tickets_open; ?></p>
<p><b>Tickets Fechados:</b> <?php echo $tickets_closed; ?></p>
<p><b>Respostas:</b> <?php echo $responses; ?></p>
<p><b>Respostas de usuários:</b> <?php echo $response_user; ?></p>
<p><b>Respostas de administradores:</b> <?php echo $response_admin; ?></p>
<p><b>Anexos:</b> <?php echo $anexos; ?></p>
<br /><br /><br />
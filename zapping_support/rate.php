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

$id = $_GET['ticketID'];

if (isset($_GET['action']) && $_GET['action'] == 'rate') {

}

$ticket = $db->query("SELECT * FROM support_ticket WHERE id = '$id'");
$ticket = $db->fetch($ticket);

$author = $db->query("SELECT * FROM support_response WHERE ticket_id = '$id'");
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
				<h1><?php echo $nome ?>		<img src="files/images/new/logo.png" alt="" style="float: right" /></h1>
			</div>
			<div id="sep"></div>
			<div id="content">
	
				<h2>Dar feedback: <?php echo $ticket['title']; ?></h2>
			
				<p>Obrigado por nos ajudar a melhorar o nosso apoio ao cliente. Abaixo você encontrará os nomes dos membros da equipe que lhe responderam. Avalie cada um com base na qualidade e velocidade de sua resposta(s).</p>
			
				<p>No entanto, lembre-se que depois de ter classificar  você não será capaz de avaliá-los novamente para o ticket.
			
				<form action="rate.php?action=rate&ticketID=<?php echo $id; ?>" method="POST">
					<table class="table">
						<tr>
							<th>Supporter</th>
							<th>Classificação</th>
						</tr>
						<?php
							while ($array = $db->fetch($author)) {
								$admin = $db->fetch($db->query("SELECT * FROM users WHERE username = '".$array['author']."'"));
								if ($admin['administration'] != '1') {
									$responses = "0";
									while($arrai = $db->fetch($author)) {
										$response = $db->fetch($db->query("SELECT * FROM users WHERE username = '".$arrai['author']."'"));
										if ($response['administration'] != '1') {
											$responses++; 
										}
									}
									echo '<tr>';
										$rate = $db->query("SELECT * FROM support_feedback WHERE ticket_id = '$id'");
										$rates = $db->numrows($rate);
										echo "<td>".$array['author']."</td>";
										if ($rates == $responses) {
											echo "<td>".$rate['rating']."<td>";
										} else {
											echo '<select name="rating" id="rating">';
												echo '<option value="5">Excelente</option>';
												echo '<option value="4">Bom</option>';
												echo '<option value="3">Regular</option>';
												echo '<option value="2">Ruim</option>';
												echo '<option value="1">Péssimo</option>';

											echo '</select>';
										}
									echo '</tr>';
								}
							}
						?>
					</table>
				
					<button type="submit" class="btn btn-success">Rate</button>
					<a style="float: right" class="btn btn-danger" href="showticket.php?ticketID=<?php echo $id; ?>">Retornar ao ticket</a>
				</form>

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
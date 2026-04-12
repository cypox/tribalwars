<?php
 #########################################
 ### Desenvolvido por: Caique Portella ###
 ###  Email: caiqueportella@gmail.com  ###
 ########  Skype: caique-portela  ########
 ## MSN: caiqueportella@hotmail.com.br  ##
 #########################################
 
require ('../../include.inc.php');
require('top.php');

$attachment = $_GET['attachment'];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" href="files/images/player/favicon.ico" />
		<meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1" />
		<title><?php echo $titulo ?></title>
			<link rel="stylesheet" type="text/css" href="../files/styles/bootstrap.min.css" />
			<link rel="stylesheet" type="text/css" href="../files/styles/player.new.css" />
			<script src="../files/js/player.js" type="text/javascript"></script>
			<script src="../files/js/swfobject.js" type="text/javascript"></script>
			<script src="../files/js/jquery.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1><?php echo $nome ?> Suporte		<img src="../files/images/new/logo.png" alt="" style="float: right" /></h1>
			</div>
			<div id="sep"></div>
			<div id="content">
				<div class="row" align="center">
					<br /><br /><br />
					<img src="../uploads/<?php echo $attachment ?>" align="center"/>
					<br /><br /><br /><br />
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</body>
</html>
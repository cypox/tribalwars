<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="icon" href="{$config.cdn}/rabe.png" type="image/x-icon"> 
	<link rel="shortcut icon" href="{$config.cdn}/rabe.png" type="image/x-icon">
	<title>Construir nova aldeia - {$config.name}</title>
	<link rel="stylesheet" type="text/css" href="{$config.cdn}/css/game.css" />
	<script src="{$config.cdn}/js/game.js" type="text/javascript"></script>
</head>
<body>
<table class="principal" align="center" style="width:800px; min-width:800px;">
	<tr>
		<td>
			<h3 style="margin-bottom:10px;">Construir nova aldeia</h3>
			{if !empty($ennobled_by)}
			<div class="error">Você teve sua última/única aldeia dominada por {$ennobled_by}. Felizmente alguns de seus guerreiros sobreviveram e estão dispostos a combater este jogador e retomar o que é seu por direito. Caso queira entrar nesta guerra...</div>
			{/if}
			<table class="vis" width="100%" cellspacing="0" align="center" style="border:1px solid #804000;">
				<tr><th colspan="2">Em que direção deseja que sua nova aldeia seja criada?</th></tr>
				<tr>
					<td width="50%" align="center">
						<form action="create_village.php?action=create" method="post">
							<table width="250" align="center" cellspacing="0" style="border:2px solid #804000;">
								<tr><th style="text-align:center;">#</th><th style="text-align:center;">Direção</th></tr>
								<tr class="lit">
									<td align="center"><input type="radio" name="direction" value="random" checked="checked" /></td>
									<td align="center">Aleatório</td>
								</tr>
								<tr class="lit">
									<td align="center"><input type="radio" name="direction" value="nw" /></td>
									<td align="center">Noroeste</td>
								</tr>
								<tr class="lit">
									<td align="center"><input type="radio" name="direction" value="no" /></td>
									<td align="center">Nordeste</td>
								</tr>
								<tr class="lit">
									<td align="center"><input type="radio" name="direction" value="sw" /></td>
									<td align="center">Sudoeste</td>
								</tr>
								<tr class="lit">
									<td align="center"><input type="radio" name="direction" value="so" /></td>
									<td align="center">Sudeste</td>
								</tr>
								<tr><th colspan="2"><span style="float:right;"><input type="submit" value="CONFIRMAR" class="button" /></span></th></tr>
							</table>
						</form>
					</td>
					<td align="center"><img src="{$config.cdn}/graphic/richtung/richtung.png" alt="" /></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table class="antet" style="width:800px; min-width:800px; height:35px;" align="center">
	<tr>
		<td class="stanga"></td>
		<td width="90%"></td>
		<td class="dreapta"></td>
	</tr>
</table>
<table class="principal" style="width:800px; min-width:800px; margin-bottom: 30px;" align="center">
	<tr><th style="text-align:center;">&copy;{php}echo date('Y');{/php} | {$config.name} - Todos os direitos reservados</th></tr>
</table>
<script type="text/javascript">setImageTitles();</script>
</body>
</html>
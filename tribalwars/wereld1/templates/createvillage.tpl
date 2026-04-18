<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="icon" href="{$config.cdn}/rabe.png" type="image/x-icon"> 
	<link rel="shortcut icon" href="{$config.cdn}/rabe.png" type="image/x-icon">
	<title>Create new village - {$config.name}</title>
	<link rel="stylesheet" type="text/css" href="{$config.cdn}/css/game.css" />
	<script src="{$config.cdn}/js/game.js" type="text/javascript"></script>
</head>
<body>
<table class="principal" align="center" style="width:800px; min-width:800px;">
	<tr>
		<td>
			<h3 style="margin-bottom:10px;">Create new village</h3>
			{if !empty($ennobled_by)}
			<div class="error">Your last/only village was conquered by {$ennobled_by}. Fortunately, some of your warriors survived and are willing to fight this player and reclaim what is yours. If you want to enter this war...</div>
			{/if}
			<table class="vis" width="100%" cellspacing="0" align="center" style="border:1px solid #804000;">
				<tr><th colspan="2">In which direction should your new village be created?</th></tr>
				<tr>
					<td width="50%" align="center">
						<form action="create_village.php?action=create" method="post">
							<table width="250" align="center" cellspacing="0" style="border:2px solid #804000;">
								<tr><th style="text-align:center;">#</th><th style="text-align:center;">Direction</th></tr>
								<tr class="lit">
									<td align="center"><input type="radio" name="direction" value="random" checked="checked" /></td>
									<td align="center">Random</td>
								</tr>
								<tr class="lit">
									<td align="center"><input type="radio" name="direction" value="nw" /></td>
									<td align="center">Northwest</td>
								</tr>
								<tr class="lit">
									<td align="center"><input type="radio" name="direction" value="no" /></td>
									<td align="center">Northeast</td>
								</tr>
								<tr class="lit">
									<td align="center"><input type="radio" name="direction" value="sw" /></td>
									<td align="center">Southwest</td>
								</tr>
								<tr class="lit">
									<td align="center"><input type="radio" name="direction" value="so" /></td>
									<td align="center">Southeast</td>
								</tr>
								<tr><th colspan="2"><span style="float:right;"><input type="submit" value="CONFIRM" class="button" /></span></th></tr>
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
	<tr><th style="text-align:center;">&copy;{php}echo date('Y');{/php} | {$config.name} - All rights reserved</th></tr>
</table>
<script type="text/javascript">setImageTitles();</script>
</body>
</html>
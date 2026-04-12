<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="icon" href="{$configy.cdn}/rabe.png" type="image/x-icon"> 
	<link rel="shortcut icon" href="{$configy.cdn}/rabe.png" type="image/x-icon">
	<title>{if $User.banned != 'Y'}Participar{else}Conta banida{/if} - {$config.name}</title>
	<link rel="stylesheet" type="text/css" href="{$configy.cdn}/css/game.css" />
	<script src="{$configy.cdn}/js/game.js" type="text/javascript"></script>
</head>
<body>
{if $User.banned != 'Y'}
<table class="principal" style="width:550px; min-width:550px; margin-top:15px;" align="center">
	<tr>
		<td>
			<h2 style="margin-bottom:5px;">Participar</h2>
			<table width="100%" style="border:1px solid #804000; margin-bottom:5px;" class="vis">
				<tr><th colspan="2">&raquo; Informações do mundo</th></tr>
				<tr><td width="150">Inicio:</td><td align="center">{$world.start|format_date}</td></tr>
				<tr><td width="150">Fim:</td><td align="center">{$world.end|format_date}</td></tr>
				<tr><td width="150">Velocidade:</td><td align="center">{$config.speed}x</td></tr>
				<tr><td width="150">Velocidade das tropas:</td><td align="center">{$config.movement_speed}x</td></tr>
				<tr><td width="150">Alojamento:</td><td align="center">{$farm.30|format_number}</td></tr>
				<tr><td width="150">Armazém:</td><td align="center">{$storage.30|format_number}</td></tr>
				<tr><td width="150">Academia:</td><td align="center">{if $config.ag_style==0}Por aldeia{elseif $config.ag_style==1}Soma das academias{elseif $config.ag_style==2}Moedas de ouro{/if}</td></tr>
				<tr><td width="150">Aldeia bonus:</td><td align="center">ativada ou desativada</td></tr>
				<tr><td width="150">Tribo:</td><td align="center">{if $config.create_ally}Ativada{else}Desativada{/if}</td></tr>
				<tr><td width="150">Recrutamento: (tribo)</td><td align="center">{if $config.leave_ally}Ativado{else}Desativado{/if}</td></tr>
				<tr><td width="150">Limite de membros:</td><td align="center">limite de membros</td></tr>
			</table>
			<table width="100%" style="border:1px solid #804000;" class="vis">
				<tr><th colspan="2">&raquo; Você deseja fazer parte deste mundo?</th></tr>
				<tr>
					<td align="center"><a href="login.php?world={$world.db}&amp;action=create&amp;h={$hkey}"><div class="button green" style="width:100px">SIM</div></a></td>
					<td align="center"><a href="index.php"><div class="button" style="width:100px">NÃO</div></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
{else}
<table class="principal" style="width:550px; min-width:550px; margin-top:15px;" align="center">
	<tr>
		<td>
			<h2 style="margin-bottom:5px;">Conta banida</h2>
			<table width="100%" style="border:1px solid #804000; margin-bottom:5px;" class="vis">
				<tr><th colspan="2">&raquo; Informações do banimento</th></tr>
				<tr><td width="150">Inicio:</td><td align="center">{$User.ban_start|format_date}</td></tr>
				<tr><td width="150">Fim:</td><td align="center">{$User.ban_end|format_date}</td></tr>
				<tr><td width="150">Motivo:</td><td align="center">{$User.ban_por|entparse}</td></tr>
			</table>
			<table width="100%" style="border:1px solid #804000;" class="vis">
				<tr><th colspan="2">&raquo; Você deseja fazer parte deste mundo?</th></tr>
				<tr>
					<td align="center"><a href="index.php"><div class="button red" style="width:100px">SAIR</div></a></td>
					<td align="center"><a href="{$config.support}"><div class="button" style="width:100px">SUPORTE</div></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
{/if}
<script type="text/javascript">setImageTitles();</script>
</body>
</html>
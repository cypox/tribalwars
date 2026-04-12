<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$cl_units->get_name($unit)}</title>
	<link rel="stylesheet" type="text/css" href="{$config.cdn}/css/game.css" />
	<script src="{$config.cdn}/js/game.js" type="text/javascript"></script>
</head>
<body>
<table class="principal" width="100%" align="center">
	<tr>
		<td>
			<table>
				<tr>
					<td><img src="{$config.cdn}/graphic/unit_big/{$cl_units->get_graphicName($unit)}_big.png" alt="{$cl_units->get_name($unit)}" /></td>
					<td>
						<h2>{$cl_units->get_name($unit)}</h2>
						<p>{$cl_units->get_description($unit)}</p>
					</td>
				</tr>
			</table>
			<table style="border: 1px solid #804000;" class="vis">
				<tr>
					<th width="150">Custos</th>
					<th>População</th>
					<th>Velocidade</th>
					<th>Capacidade de saque</th>
				</tr>
				<tr class="center">
					<td>
						<img src="{$config.cdn}/graphic/icons/wood.png" title="Madeira" />{$cl_units->get_woodprice($unit)} 
						<img src="{$config.cdn}/graphic/icons/stone.png" title="Argila" />{$cl_units->get_stoneprice($unit)} 
						<img src="{$config.cdn}/graphic/icons/iron.png" title="Ferro" />{$cl_units->get_ironprice($unit)}
					</td>
					<td><img src="{$config.cdn}/graphic/icons/farm.png" title="Arbeiter" alt="" /> {$cl_units->get_bhprice($unit)}</td>
					<td>{$cl_units->get_speed($unit,'minutes')} Minutos por campo</td>
					<td>{$cl_units->get_booty($unit)}</td>
				</tr>
			</table><br />
			<table style="border: 1px solid #804000;" class="vis">
				<tr><td>Força atacante</td><td><img src="{$config.cdn}/graphic/unit/att.png" /> {$cl_units->get_att($unit,1)}</td></tr>
				<tr><td>Defesa infantaria</td><td><img src="{$config.cdn}/graphic/unit/def.png" /> {$cl_units->get_def($unit,1)}</td></tr>
				<tr><td>Cavalaria de defesa</td><td><img src="{$config.cdn}/graphic/unit/def_cav.png" /> {$cl_units->get_defCav($unit,1)}</td></tr>
				<tr><td>Defesa arqueiros</td><td><img src="{$config.cdn}/graphic/unit/def_archer.png" /> {$cl_units->get_defArcher($unit,1)}</td></tr>
			</table><br />
			<table class="vis">
				<tr><th colspan="{$cl_units->get_countNeeded($unit)}">Requisitos</th></tr>
				<tr>
				{if count($cl_units->get_needed($unit)) > 0}
					{foreach from=$cl_units->get_needed($unit) key=n_unit item=n_stage}
					<td><a href="popup_building.php?building={$n_unit}">{$cl_builds->get_name($n_unit)}</a> (Nível {$n_stage})</td>
					{/foreach}
				{else}
					<td><div class="succes">Nenhum requisito encontrado</div></td>
				{/if}
				</tr>
			</table><br />
		</td>
	</tr>
</table>
<script type="text/javascript">setImageTitles();</script>
</body>
</html>
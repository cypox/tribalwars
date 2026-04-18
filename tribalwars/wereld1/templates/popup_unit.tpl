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
					<th width="150">Costs</th>
					<th>Population</th>
					<th>Speed</th>
					<th>Loot capacity</th>
				</tr>
				<tr class="center">
					<td>
						<img src="{$config.cdn}/graphic/icons/wood.png" title="Wood" />{$cl_units->get_woodprice($unit)} 
						<img src="{$config.cdn}/graphic/icons/stone.png" title="Clay" />{$cl_units->get_stoneprice($unit)} 
						<img src="{$config.cdn}/graphic/icons/iron.png" title="Iron" />{$cl_units->get_ironprice($unit)}
					</td>
					<td><img src="{$config.cdn}/graphic/icons/farm.png" title="Farm space" alt="" /> {$cl_units->get_bhprice($unit)}</td>
					<td>{$cl_units->get_speed($unit,'minutes')} minutes per field</td>
					<td>{$cl_units->get_booty($unit)}</td>
				</tr>
			</table><br />
			<table style="border: 1px solid #804000;" class="vis">
				<tr><td>Attack strength</td><td><img src="{$config.cdn}/graphic/unit/att.png" /> {$cl_units->get_att($unit,1)}</td></tr>
				<tr><td>Infantry defense</td><td><img src="{$config.cdn}/graphic/unit/def.png" /> {$cl_units->get_def($unit,1)}</td></tr>
				<tr><td>Cavalry defense</td><td><img src="{$config.cdn}/graphic/unit/def_cav.png" /> {$cl_units->get_defCav($unit,1)}</td></tr>
				<tr><td>Archer defense</td><td><img src="{$config.cdn}/graphic/unit/def_archer.png" /> {$cl_units->get_defArcher($unit,1)}</td></tr>
			</table><br />
			<table class="vis">
				<tr><th colspan="{$cl_units->get_countNeeded($unit)}">Requirements</th></tr>
				<tr>
				{if count($cl_units->get_needed($unit)) > 0}
					{foreach from=$cl_units->get_needed($unit) key=n_unit item=n_stage}
					<td><a href="popup_building.php?building={$n_unit}">{$cl_builds->get_name($n_unit)}</a> (Level {$n_stage})</td>
					{/foreach}
				{else}
					<td><div class="succes">No requirements found</div></td>
				{/if}
				</tr>
			</table><br />
		</td>
	</tr>
</table>
<script type="text/javascript">setImageTitles();</script>
</body>
</html>
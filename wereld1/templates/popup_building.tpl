<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$cl_builds->get_name($building)}</title>
	<link rel="stylesheet" type="text/css" href="{$config.cdn}/css/game.css" />
	<script src="{$config.cdn}/js/game.js" type="text/javascript"></script>
</head>
<body>
<table class="principal" width="100%" align="center">
	<tr>
		<td>
			<h2>{$cl_builds->get_name($building)}</h2>
			<p>{$cl_builds->get_description_bydbname($building)}</p>
			<p>Nível máximo: <b>{$cl_builds->get_maxstage($building)}</b></p>
			{if count($cl_builds->get_needed_by_dbname($building))>0}
			<table class="vis">
				<tr><th colspan="3">Requisitos</th></tr>
				<tr>
					{foreach from=$cl_builds->get_needed_by_dbname($building) key=n_building item=n_stage}
					<td><a href="popup_building.php?building={$n_building}">{$cl_builds->get_name($n_building)}</a> (Nível {$n_stage})</td>
					{/foreach}
				</tr>
			</table>
			{/if}
			<table class="vis">
				<tr>
					<th>Nível</th>
					<th width="220">Requerimenros</th>
					<th width="110">Arbeiter f�r die Stufe/insgesamt</th>
				</tr>
				{section name=foo start=1 loop=$cl_builds->get_maxstage($building)+1 step=1}
				<tr>
					<td>{$smarty.section.foo.index}</td>
					<td><img src="{$config.cdn}/graphic/holz.png" title="Holz" alt="" />{$cl_builds->get_wood($building,$smarty.section.foo.index)} <img src="{$config.cdn}/graphic/lehm.png" title="Lehm" alt="" />{$cl_builds->get_stone($building,$smarty.section.foo.index)} <img src="{$config.cdn}/graphic/eisen.png" title="Eisen" alt="" />{$cl_builds->get_iron($building,$smarty.section.foo.index)} </td>
					<td><img src="{$config.cdn}/graphic/face.png" title="Arbeiter" alt="" />{$cl_builds->get_bh($building,$smarty.section.foo.index)} / {$cl_builds->get_bh_total()}</td>
				</tr>
				{/section}
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript">setImageTitles();</script>
</body>
</html>
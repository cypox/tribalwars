<h3>Units</h3>

<table class="vis" width="100%">
<tr align="right"><th align="left">Unit</th><th><img src="graphic/holz.png" title="Wood" alt="" /></th><th><img src="graphic/lehm.png" title="Clay" alt="" /></th><th><img src="graphic/eisen.png" title="Iron" alt="" /></th><th><img src="graphic/face.png" title="Farm space" alt="" /></th>
<th><img src="graphic/unit/att.png" alt="Attack strength" /></th>
<th><img src="graphic/unit/def.png" alt="Defense (infantry)" /></th>
<th><img src="graphic/unit/def_cav.png" alt="Defense (cavalry)" /></th>
<th><img src="graphic/unit/def_archer.png" alt="Defense (archers)" /></th>
<th><img src="graphic/unit/speed.png" alt="Speed" /></th>
<th><img src="graphic/unit/booty.png" alt="Loot" /></th>
</tr>

{foreach from=$cl_units->get_array('dbname') item=dbname key=name}
	<tr>
		<td align="left"><a href="javascript:popup('popup_unit.php?unit={$dbname}', 550, 520)"><img src="graphic/unit/{$dbname}.png" alt="" /> {$name}</a></td>
		<td>{$cl_units->get_woodprice($dbname)}</td><td>{$cl_units->get_stoneprice($dbname)}</td><td>{$cl_units->get_ironprice($dbname)}</td>
		<td>{$cl_units->get_bhprice($dbname)}</td>
		<td>{$cl_units->get_att($dbname,1)}</td><td>{$cl_units->get_def($dbname,1)}</td><td>{$cl_units->get_defcav($dbname,1)}</td><td>{$cl_units->get_defarcher($dbname,1)}</td>

		<td>{$cl_units->get_speed($dbname,'minutes')}</td>
		<td>{$cl_units->get_booty($dbname)}</td>
	</tr>
{/foreach}
</table><br />
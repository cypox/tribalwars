{if !empty($error)}<div class="error">{$error}</div>{/if}
<h3>Distribuir ordens</h3>
<form name="units" action="game.php?village={$village.id}&amp;screen=place&amp;try=confirm" method="post">
	<table>
		<tr>
			{assign var=counter value=0}
			{foreach from=$group_units key=group_name item=value}
				<td width="150" valign="top">
					<table class="vis" width="100%">
						{foreach from=$group_units.$group_name item=dbname}
							{math assign=counter equation="x + y" x=$counter y=1}
							<tr><td><a href="javascript:popup('popup_unit.php?unit={$dbname}', 520, 520)"><img src="{$config.cdn}/graphic/unit/{$dbname}.png" title="{$cl_units->get_name($dbname)}" alt="" /></a> <input id="input_{$dbname}" name="{$dbname}" type="text" size="5" tabindex="{$counter}" value="{$values.$dbname}" class="unitsInput" /> <a href="javascript:void(0)" onclick="insertUnit($('#input_{$dbname}'), {$units.$dbname})">({$units.$dbname})</a></td></tr>
						{/foreach}
					</table>
				</td>
			{/foreach}
		</tr>
		<tr><td><a id="selectAllUnits" href="javascript:void(0);" onclick="selectAllUnits(true)">&raquo; Todas tropas</a></td></tr>
	</table>
	<table>
		<tr>
			<td>X: <input type="text" name="x" tabindex="13" id="inputx" value="{$values.x}" size="5" maxlength="3" onkeyup="xProcess('inputx', 'inputy')" /></td>
			<td>Y: <input type="text" name="y" tabindex="14" id="inputy" value="{$values.y}" size="5" maxlength="3" /></td>
			<td rowspan="2"><input class="button red" name="attack" type="submit" value="ATACAR" /></td>
			<td rowspan="2"><input class="button green" name="support" type="submit" value="APOIAR" /></td>
		</tr>
	</table>
</form>
{if count($my_movements)>0}
<h3>Seus comandos</h3>
<table class="vis">
	<tr>
		<th width="250">Comando</th>
		<th width="160">Chegada</th>
		<th width="80">Chegada em</th>
	</tr>
	{foreach from=$my_movements item=array}
	    <tr>
	        <td>
	            <a href="game.php?village={$village.id}&amp;screen=info_command&amp;id={$array.id}&amp;type=own">
	            <img src="{$config.cdn}/graphic/command/{$array.type}.png"> {$array.message}
	            </a>
	        </td>
	        <td>{$array.end_time|format_date}</td>
	        {if $array.arrival_in<0}
	        	<td>{$array.arrival_in|format_time}</td>
	        {else}
	        	<td><span class="timer">{$array.arrival_in|format_time}</span></td>
	        {/if}
	        {if $array.can_cancel}
	        	<td><a href="game.php?village={$village.id}&amp;screen=place&amp;action=cancel&amp;id={$array.id}&amp;h={$hkey}">cancelar</a></td>
	        {/if}
	    </tr>
	{/foreach}
</table>
{/if}
{if count($other_movements)>0}
<h3>Tropas em chegada</h3>
<table class="vis">
	<tr>
		<th width="250">Origem</th>
		<th width="160">Chegada</th>
		<th width="80">Chegada em</th>
	</tr>
	{foreach from=$other_movements item=array}
	    <tr>
	        <td>
	            <a href="game.php?village={$village.id}&amp;screen=info_command&amp;id={$array.id}&amp;type=other">
	            <img src="{$config.cdn}/graphic/command/{$array.type}.png"> {$array.message}
	            </a>
	        </td>
	        <td>{$array.end_time|format_date}</td>
	        {if $array.arrival_in<0}
	        	<td>{$array.arrival_in|format_time}</td>
	        {else}
	        	<td><span class="timer">{$array.arrival_in|format_time}</span></td>
	        {/if}
	    </tr>
	{/foreach}
</table>
{/if}
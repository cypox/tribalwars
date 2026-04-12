<table class="vis" width="100%">
	<tr>
		<th>Comando</th>
		<th>Origem</th>
		<th>Chegada em</th>
		{foreach from=$cl_units->get_array("dbname") item=dbname key=name}<th width="30"><div align="center"><img src="{$config.cdn}/graphic/unit/{$dbname}.png" title="{$name}" /></div></th>{/foreach}
	</tr>
	{foreach from=$my_movements item=array}
	<tr class="row_a">
		<td><a href="game.php?village={$village.id}&amp;screen=info_command&amp;id={$array.id}&amp;type=own">{$array.message}</a></td>
		<td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$array.homevillageid}">{$array.homevillagename}</a></td>
		<td>{$array.arrival_in|format_time}</td>
		{foreach from=$array.units item=num}
			{if $num==0}
		<td class="hidden">0</td>
			{else}
		<td>{$num}</td>
			{/if}
		{/foreach}
	</tr>
	{/foreach}	
</table>
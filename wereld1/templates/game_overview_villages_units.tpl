<table class="vis" style="width:100%">
	<tr>
		<th>Aldeias</th>
		<th>&nbsp;</th>
		{foreach from=$unit item=name key=dbname}<th width="35"><div align="center"><img src="{$config.cdn}/graphic/unit/{$dbname}.png" title="{$name}" /></div></th>{/foreach}
		<th>Ação</th>
	</tr>
	{foreach from=$villages item=id key=arr_id}
	<tr class="{$villages.$arr_id.lit}">
		<td rowspan="3" valign="top">{if $villages.$arr_id.attacks!=0}<img src="{$config.cdn}/graphic/command/attack.png"> {/if}<a href="game.php?village={$arr_id}&screen=overview">{$villages.$arr_id.name} ({$villages.$arr_id.x}|{$villages.$arr_id.y}) K{$villages.$arr_id.continent}</a></td>
		<td>Suas tropas</td>
		{foreach from=$unit item=name key=dbname}
			{if $own_units.$arr_id.$dbname==0}
		<td class="hidden">{$own_units.$arr_id.$dbname}</td>
			{else}
		<td align="center">{$own_units.$arr_id.$dbname}</td>
			{/if}
		{/foreach}
		<td><a href="game.php?village={$village.id}&amp;screen=place">Praça</a></td>
	</tr>
	<tr class="{$villages.$arr_id.lit}units_there">
		<td>Total</td>
		{foreach from=$unit item=name key=dbname}
			{if $all_units.$arr_id.$dbname==0}
		<td class="hidden">{$all_units.$arr_id.$dbname}</td>
			{else}
		<td align="center">{$all_units.$arr_id.$dbname}</td>
			{/if}
		{/foreach}
		<td rowspan="2"><a href="game.php?village={$village.id}&amp;screen=place&amp;mode=units">Tropas</a></td>
	</tr>
	<tr class="{$villages.$arr_id.lit}units_away">
		<td>Fora</td>
		{foreach from=$unit item=name key=dbname}
			{if $villages.$arr_id.outward.$dbname==0}
		<td class="hidden">{$villages.$arr_id.outward.$dbname}</td>
			{else}
		<td align="center">{$villages.$arr_id.outward.$dbname}</td>
			{/if}
		{/foreach}
	</tr>
	{/foreach}
</table>
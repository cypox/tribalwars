<table class="vis">
	<tr>
{foreach from=$links item=f_mode key=f_name}
	{if $f_mode==$mode}
		<td class="selected" width="100" align="center"><a href="game.php?village={$village.id}&screen=overview_villages&mode={$f_mode}">&raquo; {$f_name} &laquo;</a></td>
	{else}
		<td width="100" align="center"><a href="game.php?village={$village.id}&screen=overview_villages&mode={$f_mode}">{$f_name}</a></td>	
	{/if}
{/foreach}
	</tr>
</table>
{include file="game_overview_villages_$mode.tpl"}
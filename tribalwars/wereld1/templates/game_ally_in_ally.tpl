<h2 style="font-size:20px; font-weight:bold; text-transform:uppercase; margin-bottom:0px;"><div align="center">{$ally.name}</div></h2>
{if !empty($error)}<div class="error">{$error}</div>{/if}
<table class="vis" id="menu" width="100%" style="border:1px solid #804000;">
	<tr><th colspan="100%">Submenus</th></tr>
	<tr>
	{foreach from=$links item=f_mode key=f_name}
		{if $f_mode==$mode}
		<td class="selected" width="100" align="center"><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode={$f_mode}">&raquo; {$f_name} &laquo;</a></td>
		{else}
		<td width="100" align="center"><a href="game.php?village={$village.id}&amp;screen=ally&amp;mode={$f_mode}">{$f_name}</a></td>
		{/if}
	{/foreach}
	</tr>
</table><br />
{if $mode=='profile'}
	{include file="game_info_ally.tpl"}
{elseif $mode=='rights'}
	{include file="game_ally_in_ally_rights.tpl"}
{else}
	{if in_array($mode,$links)}
		{include file="game_ally_in_ally_$mode.tpl"}
	{/if}
{/if}
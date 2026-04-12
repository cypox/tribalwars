{if !empty($error)}
<div class="error">{$error}</div>
{else}
<h2>{$mov.message}</h2>
	{if $type=='own'}
<table class="vis" width="50%" style="border:1px solid #804000; margin-left:5px;">
	<tr><th colspan="2">Comando</th></tr>
	<tr><td>Aldeia:</td><td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$mov.to_village}">{$mov.to_villagename} ({$mov.to_x}|{$mov.to_y}) K{$mov.to_continent}</a></td></tr>
	<tr><td>Jogador:</td><td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$mov.to_userid}">{if empty($mov.to_username)}---{else}{$mov.to_username}{/if}</a></td></tr>
	<tr><td>Duração:</td><td>{$mov.duration}</td></tr>
	<tr><td>Chegada:</td><td>{$mov.arrival}</td></tr>
	<tr><td>Chegada em:</td><td><span class="timer">{$mov.arrival_in}</span></td></tr>
	<tr><td>Origem:</td><td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$mov.from_village}">{$mov.from_villagename} ({$mov.from_x}|{$mov.from_y}) K{$mov.from_continent}</a></td></tr>
	<tr><td colspan="2"><a href="game.php?village={$village.id}&amp;&amp;screen=map&x={$mov.to_x}&y={$mov.to_y}">&raquo; Centralizar no mapa</a></td></tr>
	<tr><td colspan="2"><a href="game.php?village={$village.id}&amp;&amp;screen=place">&raquo; Praça de reunião</a></td></tr>
		{if $mov.cancel}
	<tr><td colspan="2"><a href="game.php?village={$village.id}&screen=place&action=cancel&id={$mov.id}&h={$hkey}">&raquo; Cancelar comando</a></td></tr>
		{/if}	
</table>
<table class="vis" width="50%" style="border:1px solid #804000; margin-left:5px; margin-top:5ps;">
	<tr>
		{foreach from=$cl_units->get_array("dbname") item=dbname key=name}
		<th width="50"><div align="center"><img src="{$config.cdn}/graphic/unit/{$dbname}.png" title="{$name}" alt="" /></div></th>
		{/foreach}
	</tr>
	<tr>{foreach from=$mov.units item=num_units}{if $num_units>0}<td>{$num_units}</td>{else}<td class="hidden">0</td>{/if}{/foreach}</tr>
</table>
		{if $mov.wood != 0 || $mov.stone != 0 || $mov.iron != 0}
<table class="vis">
	<tr>
		<th>Saque:</th>
		<td>
			{if $mov.wood > 0}<img src="{$config.cdn}/graphic/icons/wood.png" title="Madeira" alt="" />{$mov.wood} {/if}
			{if $mov.stone > 0}<img src="{$config.cdn}/graphic/icons/stone.png" title="Argila" alt="" />{$mov.stone} {/if}
			{if $mov.iron > 0}<img src="{$config.cdn}/graphic/icons/iron.png" title="Ferro" alt="" />{$mov.iron} {/if}
		</td>
	</tr>
</table>
		{/if}
	{else}
<table class="vis" width="50%" style="border:1px solid #804000; margin-left:5px; margin-top:5ps;">
	<tr><th colspan="2">Comando</th></tr>
	<tr><td>Origem:</td><td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$mov.from_village}">{$mov.from_villagename} ({$mov.from_x}|{$mov.from_y}) K{$mov.from_continent}</a></td></tr>
	<tr><td>Jogador:</td><td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$mov.from_userid}">{$mov.from_username}</a></td></tr>
	<tr><td>Chegada:</td><td>{$mov.arrival}</td></tr>
	<tr><td>Chegada em:</td><td><span class="timer">{$mov.arrival_in}</span></td></tr>
</table>
	{/if}
{/if}
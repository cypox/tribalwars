<table class="vis" width="100%">
	<tr>
		<th>Aldeias</th>
		<th><div align="center"><img src="{$config.cdn}/graphic/overview/main.png" title="Castelo" alt="" /></div></th>
		<th><div align="center"><img src="{$config.cdn}/graphic/overview/barracks.png" title="Quartel" alt="" /></div></th>
		<th><div align="center"><img src="{$config.cdn}/graphic/overview/stable.png" title="Estábulo" alt="" /></div></th>
		<th><div align="center"><img src="{$config.cdn}/graphic/overview/garage.png" title="Oficina" alt="" /></div></th>
		<th><div align="center"><img src="{$config.cdn}/graphic/overview/smith.png" title="Ferreiro" alt="" /></div></th>
		<th><div align="center"><img src="{$config.cdn}/graphic/overview/farm.png" title="Moinho" alt="" /></div></th>
		{foreach from=$unit item=name key=dbname}<th width="35"><div align="center"><img src="{$config.cdn}/graphic/unit/{$dbname}.png" title="{$name}" /></div></th>{/foreach}
		<th><div align="center"><img src="{$config.cdn}/graphic/overview/trader.png" title="Mercadores" alt="" /></div></th>
	</tr>
{foreach from=$villages item=arr key=arr_id}
	<tr class="{$villages.$arr_id.lit}">
		<td>{if $villages.$arr_id.attacks!=0}<img src="{$config.cdn}/graphic/command/attack.png"> {/if}<a href="game.php?village={$arr_id}&screen=overview">{$villages.$arr_id.name} ({$villages.$arr_id.x}|{$villages.$arr_id.y}) K{$villages.$arr_id.continent}</a></td>
	{if isset($villages.$arr_id.first_build.buildname)}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=main"><span class="dot green" title="{$villages.$arr_id.first_build.buildname}: {$villages.$arr_id.first_build.end_time}"></span></a></td>
	{else}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=main"><span class="dot brown" title="Sem produção"></span></a></td>
	{/if}

	{if $villages.$arr_id.barracks==0}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=barracks"><span class="dot grey" title="Impossivel produzir"></span></a></td>
	{elseif !empty($villages.$arr_id.barracks_prod.unit)}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=barracks"><span class="dot green" title="{$villages.$arr_id.barracks_prod.unit}: {$villages.$arr_id.barracks_prod.time}"></span></a></td>
	{else}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=barracks"><span class="dot brown" title="Sem produção"></span></a></td>
	{/if}

	{if $villages.$arr_id.stable==0}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=stable"><span class="dot grey" title="Impossivel produzir"></span></a></td>
	{elseif !empty($villages.$arr_id.stable_prod.unit)}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=stable"><span class="dot green" title="{$villages.$arr_id.stable_prod.unit}: {$villages.$arr_id.stable_prod.time}"></span></a></td>
	{else}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=stable"><span class="dot brown" title="Sem produção"></span></a></td>
	{/if}

	{if $villages.$arr_id.garage==0}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=garage"><span class="dot grey" title="Impossivel produzir"></span></a></td>
	{elseif !empty($villages.$arr_id.garage_prod.unit)}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=garage"><span class="dot green" title="{$villages.$arr_id.garage_prod.unit}: {$villages.$arr_id.garage_prod.time}"></span></a></td>
	{else}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=garage"><span class="dot brown" title="Sem produção"></span></a></td>
	{/if}

	{if $villages.$arr_id.smith==0}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=smith"><span class="dot yellow" title="Ferreiro não construído"></span></a></td>
	{elseif !empty($villages.$arr_id.first_tec.tecname)}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=smith"><span class="dot green" title="{$villages.$arr_id.first_tec.tecname}: {$villages.$arr_id.first_tec.end_time}"></span></a></td>
	{else}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=smith"><span class="dot brown" title="Sem produção"></span></a></td>
	{/if}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=farm">{$villages.$arr_id.max_farm-$villages.$arr_id.r_bh} ({$villages.$arr_id.farm})</a></td>
	{foreach from=$unit item=name key=dbname}
		{if $villages.$arr_id.$dbname==0}<td class="hidden">{$villages.$arr_id.$dbname}</td>{else}<td align="center">{$villages.$arr_id.$dbname}</td>{/if}
	{/foreach}
		<td align="center"><a href="game.php?village={$arr_id}&amp;screen=market">{$villages.$arr_id.dealers.in_village}/{$villages.$arr_id.dealers.max_dealers}</a></td>
	</tr>
{/foreach}
</table>
<table class="vis" width="100%">
	<tr>
		<th>Aldeias</th>
		<th>Pontos</th>
		<th>Recursos</th>
		<th>Armazém</th>
		<th>Moinho</th>
		<th>Construção</th>
		<th>Pesquisa</th>
		<th>Recrutamento</th>
	</tr>
{foreach from=$villages item=id key=arr_id}
	<tr class="{$villages.$arr_id.lit}">
		<td>{if $villages.$arr_id.attacks!=0}<img src="{$config.cdn}/graphic/command/attack.png"> {/if}<a href="game.php?village={$arr_id}&screen=overview">{$villages.$arr_id.name} ({$villages.$arr_id.x}|{$villages.$arr_id.y}) K{$villages.$arr_id.continent}</a></td>
		<td align="center">{$villages.$arr_id.points}</td>
		<td align="center"><img src="{$config.cdn}/graphic/icons/wood.png" title="Madeira" alt="" />{if $villages.$arr_id.r_wood==$villages.$arr_id.max_storage}<span class="warn">{/if}{$villages.$arr_id.r_wood}{if $villages.$arr_id.r_wood==$villages.$arr_id.max_storage}</span>{/if} <img src="{$config.cdn}/graphic/icons/stone.png" title="Argila" alt="" />{if $villages.$arr_id.r_stone==$villages.$arr_id.max_storage}<span class="warn">{/if}{$villages.$arr_id.r_stone}{if $villages.$arr_id.r_stone==$villages.$arr_id.max_storage}</span>{/if} <img src="{$config.cdn}/graphic/icons/iron.png" title="Ferro" alt="" />{if $villages.$arr_id.r_iron==$villages.$arr_id.max_storage}<span class="warn">{/if}{$villages.$arr_id.r_iron}{if $villages.$arr_id.r_iron==$villages.$arr_id.max_storage}</span>{/if} </td>
		<td align="center">{$villages.$arr_id.max_storage}</td>
		<td align="center">{$villages.$arr_id.r_bh}/{$villages.$arr_id.max_farm}</td>
		{if isset($villages.$arr_id.first_build.buildname)}
		<td align="center"><b>{$villages.$arr_id.first_build.buildname}</b><br />{$villages.$arr_id.first_build.end_time}</td>
		{else}
	    <td></td>
		{/if}
		{if isset($villages.$arr_id.first_tec.tecname)}
		<td align="center"><b>{$villages.$arr_id.first_tec.tecname}</b><br />{$villages.$arr_id.first_tec.end_time}</td>
		{else}
	    <td></td>
		{/if}
		<td align="center">{foreach from=$villages.$arr_id.recruits item=arr_rec key=id_rec}<img src="{$config.cdn}/graphic/unit/{$arr_rec.dbname}.png" title="{$arr_rec.num} {$arr_rec.unit}" alt="">{/foreach}</td>
	</tr>
{/foreach}
</table>
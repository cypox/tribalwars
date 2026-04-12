<table class="vis" width="100%">
	<tr>
		<th style="width:100px;" colspan="2">Edifício</th>
		<th style="width:250px;">Duração</th>
		<th style="width:250px;">Construir</th>
	</tr>
{foreach from=$builds item=dbname key=id}

<tr {if $cl_builds->get_maxstage($dbname) == $build_village.$dbname}class="fulfilled"{/if}{if $cl_builds->get_maxstage($dbname) == $build_village.$dbname && $smarty.cookies.fulfilled_hide == 1} style="display: none;"{/if}>
        
        <th width="25"><div align="center"><a href="javascript:popup_scroll('popup_building.php?building={$dbname}', 520, 520)"><img src="{$config.cdn}/graphic/buildings/{$dbname}.png"></a></div></th>
        <td><a href="game.php?village={$village.id}&screen={$dbname}">{$cl_builds->get_name($dbname)}</a> <span style="float:right;">(<b>Max {$cl_builds->get_maxstage($dbname)}</b>|{$village.$dbname|stage})</span></td>
        
		
        {if ($destroy_village.$dbname <= 15) && ($dbname == 'main') || ($destroy_village.$dbname <= 1) && (intval(in_array($dbname, $builds_start_by_one))) || ($destroy_village.$dbname <= 0)}
		<td align="center" colspan="2" class="inactive">Este edifício já atingiu seu nível minimo</td>
		{else}
		<td align="center">{$cl_builds->get_time($village.main,$dbname,$destroy_village.$dbname+1)|format_time}</td>
		<td align="center"><a href="game.php?village={$village.id}&amp;screen=main&amp;mode=destroy&amp;action=destroy&amp;building_id={$dbname}&amp;h={$hkey}">{if ($destroy_village.$dbname-1) <= 0}Demolir edifício{else}Demolir para nível {$destroy_village.$dbname-1}{/if}</a></td>
{/if}
</tr>
{/foreach}
</table>
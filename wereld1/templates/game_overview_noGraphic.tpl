<h2>{$village.name} ({$village.x}|{$village.y}) K{$village.continent}</h2>
<table width="100%">
	<tr>
		<td width="450" valign="top">
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr><th colspan="2">Edifícios</th></tr>
				{foreach from=$built_builds item=dbname key=id}
					<tr>
						<td width="50%"><a href="game.php?village={$village.id}&screen={$dbname}"><img src="{$config.cdn}/graphic/buildings/{$dbname}.png"> {$cl_builds->get_name($dbname)}</a> ({$village.$dbname|stage})</td>
						<td width="50%">{$villageOverviewDatas->get($dbname)}</td>
					</tr>
				{/foreach}
			</table>
			{if count($other_movements)>0}
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr>
					<th width="250">Tropas chegando</th>
					<th width="160">Chegada</th>
					<th width="80">Chegada em</th>
				</tr>
				{foreach from=$other_movements item=array}
				    <tr>
				        <td><a href="game.php?village={$village.id}&amp;screen=info_command&amp;id={$array.id}&amp;type=other"><img src="{$config.cdn}/graphic/command/{$array.type}.png"> {$array.message}</a></td>
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
			{if count($my_movements)>0}
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr>
					<th width="250">Seus comandos</th>
					<th width="160">Chegada</th>
					<th width="80">Chegada em</th>
				</tr>
				{foreach from=$my_movements item=array}
				    <tr>
				        <td><a href="game.php?village={$village.id}&amp;screen=info_command&amp;id={$array.id}&amp;type=own"><img src="{$config.cdn}/graphic/command/{$array.type}.png"> {$array.message}</a></td>
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
			{/if}<br />
			<a href="game.php?village={$village.id}&amp;screen=overview&amp;action=set_visual&amp;visual=1&amp;h={$hkey}">&raquo; Visualização gráfica da aldeia</a>
		</td>
		<td valign="top">
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr><th colspan="2">Produção</th></tr>
				<tr><td width="90"><img src="{$config.cdn}/graphic/holz.png" title="Madeira" alt="" /> Madeira</td><td><strong>{$wood_prod_overview}</strong> por {if $speed > 10}Minuto{else}Hora{/if}</td></tr>
				<tr><td><img src="{$config.cdn}/graphic/lehm.png" title="Argila" alt="" /> Argila</td><td><strong>{$stone_prod_overview}</strong> por {if $speed > 10}Minuto{else}Hora{/if}</td></tr>
				<tr><td><img src="{$config.cdn}/graphic/eisen.png" title="Ferro" alt="" /> Ferro</td><td><strong>{$iron_prod_overview}</strong> por {if $speed > 10}Minuto{else}Hora{/if}</td></tr>
			</table>
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr><th>Unidades</th></tr>
                {foreach from=$in_village_units item=num key=dbname}
                	<tr><td><img src="{$config.cdn}/graphic/unit/{$dbname}.png"> <b>{$num}</b> {$cl_units->get_name($dbname)}</td></tr>
                {/foreach}
			</table><br />
			{if $village.agreement != 100}
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr><th>Lealdade:</th><th>{$village.agreement}</th></tr>
			</table>
			{/if}
		</td>
	</tr>
</table>
<h2>{$village.name} ({$village.x}|{$village.y}) K{$village.continent}</h2>
<table width="100%">
	<tr>
		<td width="450" valign="top">
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr><th colspan="2">Buildings</th></tr>
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
					<th width="250">Incoming troops</th>
					<th width="160">Arrival</th>
					<th width="80">Arrival in</th>
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
					<th width="250">Your commands</th>
					<th width="160">Arrival</th>
					<th width="80">Arrival in</th>
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
				        	<td><a href="game.php?village={$village.id}&amp;screen=place&amp;action=cancel&amp;id={$array.id}&amp;h={$hkey}">cancel</a></td>
				        {/if}
				    </tr>
				{/foreach}
			</table>
			{/if}<br />
			<a href="game.php?village={$village.id}&amp;screen=overview&amp;action=set_visual&amp;visual=1&amp;h={$hkey}">&raquo; Graphical village overview</a>
		</td>
		<td valign="top">
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr><th colspan="2">Production</th></tr>
				<tr><td width="90"><img src="{$config.cdn}/graphic/holz.png" title="Wood" alt="" /> Wood</td><td><strong>{$wood_prod_overview}</strong> per {if $speed > 10}minute{else}hour{/if}</td></tr>
				<tr><td><img src="{$config.cdn}/graphic/lehm.png" title="Clay" alt="" /> Clay</td><td><strong>{$stone_prod_overview}</strong> per {if $speed > 10}minute{else}hour{/if}</td></tr>
				<tr><td><img src="{$config.cdn}/graphic/eisen.png" title="Iron" alt="" /> Iron</td><td><strong>{$iron_prod_overview}</strong> per {if $speed > 10}minute{else}hour{/if}</td></tr>
			</table>
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr><th>Units</th></tr>
                {foreach from=$in_village_units item=num key=dbname}
                	<tr><td><img src="{$config.cdn}/graphic/unit/{$dbname}.png"> <b>{$num}</b> {$cl_units->get_name($dbname)}</td></tr>
                {/foreach}
			</table><br />
			{if $village.agreement != 100}
			<table class="vis" width="100%" style="margin-bottom:3px; border-spacing:1px;">
				<tr><th>Loyalty:</th><th>{$village.agreement}</th></tr>
			</table>
			{/if}
		</td>
	</tr>
</table>
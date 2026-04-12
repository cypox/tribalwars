<table>
	<tr>
    	<td>
			<img src="{$config.cdn}/graphic/big_buildings/market1.png" title="Lehmgrube" alt="" />
		</td>   
		<td>
			<h2>Mercado ({$village.market|stage})</h2>
			{$description}
		</td>
	</tr>
</table><br />
{if $show_build}
<table width="100%">
	<tr>
		<td valign="top" width="100">
			<table class="vis" width="100%">
		{foreach from=$links item=f_mode key=f_name}
			{if $f_mode==$mode}
				<tr>
					<td class="selected" width="120">
						<a href="game.php?village={$village.id}&amp;screen=market&amp;mode={$f_mode}">{$f_name}</a>
					</td>
				</tr>
			{else}
                <tr>
                    <td width="120">
						<a href="game.php?village={$village.id}&amp;screen=market&amp;mode={$f_mode}">{$f_name}</a>
					</td>
				</tr>
			{/if}
		{/foreach}
			</table>
		</td>
		<td valign="top" width="*">
		{if in_array($mode,$allow_mods)}
			{include file="game_market_$mode.tpl" title=foo}
		{/if}
		</td>
	</tr>
</table>
{/if}
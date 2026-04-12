<h2>Berichte</h2>

<table width="100%">
	<tr>
		<td valign="top" width="15%">
			<table class="vis" width="100%">
				{foreach from=$links item=f_mode key=f_name}
					{if $f_mode==$mode}
						<tr>
							<td class="selected" width="120">
								<a href="game.php?village={$village.id}&amp;screen=report&amp;mode={$f_mode}">&raquo; {$f_name}</a>
							</td>
						</tr>
					{else}
		                <tr>
		                    <td width="120">
								<a href="game.php?village={$village.id}&amp;screen=report&amp;mode={$f_mode}">{$f_name}</a>
							</td>
						</tr>
					{/if}
				{/foreach}
			</table>
		</td>
		<td valign="top">
			{include file="game_report_$do.tpl"}
		</td>
	</tr>
</table>
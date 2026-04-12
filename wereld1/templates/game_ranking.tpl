<table width="100%" align="center">
	<tr>
		<td>
			<h2>Rangliste</h2>
				<table>
					<tr>
						<td valign="top" width="120">
							<table class="vis">
                                {foreach from=$links item=f_mode key=f_name}
									{if $f_mode==$mode}

								<tr>
                        			<td class="selected" width="120">
										<a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode={$f_mode}">{$f_name}</a>
									</td>
                    			</tr>

									{else}
                    			<tr>
                        		<td width="120">
									<a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode={$f_mode}">{$f_name}</a>
								</td>
							</tr>
									{/if}
								{/foreach}
                		</table>
            		</td>
					<td valign="top" align="left">

						{if in_array($mode,$allow_mods)}

							{include file="game_ranking_$mode.tpl" title=foo}

						{/if}
            		</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

{if $page == 'mark'}
	{include file='game_map_mark.tpl'}
{else}
	<div id="info" style="position:absolute; top:0px; left:0px; width:350px; height:1px; visibility: hidden; z-index:10"></div>
	<h2>Continente {$continent}</h2>
	<table collspacing="0" collpadding="0" width="100%">
		<tr>
			<td valign="top">
				<table class="vis" style="border: 1px solid #804000; margin-bottom:5px;" align="center">
					<tr class="nowrap">
						<th valign="top">Padrão:</th>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(255,255,255)"></th>
						<td style="white-space:normal"> Aldeia atual</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(240,200,0)"></th>
						<td style="white-space:normal; width:100px;"> Suas aldeias</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(0,0,244)"></th>
						<td style="white-space:normal"> Sua tribo</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(150,150,150)"></th>
						<td style="white-space:normal"> Abandonadas</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(130,60,10)"></th>
						<td style="white-space:normal"> Outras aldeias</td>
					</tr>
					<tr class="nowrap">
						<th valign="top">Tribo:</th>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(0,160,244)"></th>
						<td style="white-space:normal;"> Aliados</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(128,0,128)"></th>
						<td style="white-space:normal;" colspan="3"> Pactos de não-agressão (PNA)</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(244,0,0)"></th>
						<td style="white-space:normal" colspan="3"> Inimigos</td>
					</tr>
				</table>
				<table cellspacing="0" cellpadding="0" class="vis" style="border: 1px solid #804000;" width="100%">
					<tr>
						<th></th>
						<th><div align="center"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x}&amp;y={$map.y+$map.size}"><img src="{$config.cdn}/graphic/map/map_n.png" style="z-index:1; position:relative;" /></a></div></th>
						<th></th>
					</tr>
					<tr>
						<th align="center"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x-$map.size+1}&amp;y={$map.y}"><img src="{$config.cdn}/graphic/map/map_w.png" style="z-index:1; position:relative;" /></a></th>
						<td>
							<table style="background-color:rgba(0, 0, 0, 0.5); background-color:rgb(0, 0, 0); border:1px solid #000; border-spacing:0px;" cellpadding="0" class="map" width="100%">
								{foreach from=$y_coords item=y}
									<tr>
										<td width="20">{$y}</td>
										{foreach from=$x_coords item=x}
											{if !$cl_map->getVillage($x,$y)}
												{if $image_objects.$x.$y}
												<td id="tile_{$x}_{$y}" class="{$cl_map->getClass($x,$y)}"><img src="{$config.cdn}/graphic/{$map_base}/{$image_objects.$x.$y}" /></td>
												{else}
												<td id="tile_{$x}_{$y}" class="{$cl_map->getClass($x,$y)}"><img src="{$config.cdn}/graphic/{$map_base}/{$cl_map->graphic($x,$y)}" /></td>
												{/if}
											{else}
												<!-- <td id="tile_{$x}_{$y}" class="{$cl_map->getClass($x,$y)}" style="background-color:rgb({$cl_map->getColor($x,$y)})"><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$cl_map->getvillageid($x,$y)}"><img src="{$config.cdn}/graphic/{$map_base}/{$cl_map->graphic($x,$y)}" onmouseover="showinfo({$cl_map->getvillageid($x,$y)}, {$user.id}, {$village.x}, {$village.y});" onmouseout="hideinfo();" alt="" /></a></td>	 -->

												<td "id="tile_{$x}_{$y}" class="{$cl_map->getClass($x,$y)}" style="background-color:rgb({$cl_map->getColor($x,$y)})"><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$cl_map->getvillageid($x,$y)}"><img src="{$config.cdn}/graphic/{$map_base}/{$cl_map->graphic($x,$y)}{php}if (get_bonus($this->_tpl_vars[x], $this->_tpl_vars[y])) echo 'b.png';{/php}" onmouseover="showinfo({$cl_map->getvillageid($x,$y)}, {$user.id}, {$village.x}, {$village.y});" onmouseout="hideinfo();" alt="" /></a></td>	



											{/if}
										{/foreach}
									</tr>
								{/foreach}
								<tr>
									<td height="20"></td>
									{foreach from=$x_coords item=x}
										<td>{$x}</td>
									{/foreach}
								</tr>
							</table>
						</td>
						<th align="center"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x+$map.size-1}&amp;y={$map.y}"><img src="{$config.cdn}/graphic/map/map_e.png" style="z-index:1; position:relative;" /></a></th>
					</tr>
					<tr>
						<th></th>
						<th><div align="center"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x}&amp;y={$map.y-$map.size}"><img src="{$config.cdn}/graphic/map/map_s.png" style="z-index:1; position:relative;" /></a></div></th>
						<th></th>
					</tr>
				</table>
			</td>
			<td valign="top" width="100%" align="center">
				<table class="vis" style="border: 1px solid #804000; margin-bottom:5px;" width="">
					<tr><th colspan="3">Centralizar mapa</th></tr>
					<tr>
						<form style="text-align:center;" action="game.php?village={$village.id}&amp;screen=map" method="post">
							<td>X: <input type="text" class="datax" name="x" maxlength="3" size="3" id="inputx" value="{$map.x}" onkeyup="xProcess('inputx', 'inputy')" /></td>
							<td>Y: <input type="text" class="datay" name="y" maxlength="3" size="3" id="inputy" value="{$map.y}" ></td>
							<td><input type="submit" class="button" name="go" value="OK" /></td>
						</form>
					</tr>
				</table>
				<table cellspacing="0" cellpadding="0" class="vis" style="border: 1px solid #804000;" width="77%">
					<tr>
						<th></th>
						<th><div align="center"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x}&amp;y={$map.y+50}"><img src="{$config.cdn}/graphic/map/map_n.png" style="z-index:1; position:relative;" /></a></div></th>
						<th></th>
					</tr>
					<tr>
						<th><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x-50}&amp;y={$map.y}"><img src="{$config.cdn}/graphic/map/map_w.png" style="z-index:1; position:relative;" /></a></th>
						<td>
							<form action="game.php?village={$village.id}&screen=map" method="post">
								<input type="hidden" name="curx" value="{$map.x}" maxlength="3" />
								<input type="hidden" name="cury" value="{$map.y}" maxlength="3" />
								<input type="image" name="" style="cursor:hand;" src="minimap.php?x={$map.x}&y={$map.y}&id={$village.id}&hkey={$hkey}" />
							</form>
						</td>
						<th><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x+50}&amp;y={$map.y}"><img src="{$config.cdn}/graphic/map/map_e.png" style="z-index:1; position:relative;" /></a></th>
					</tr>
					<tr>
						<th></th>
						<th><div align="center"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x}&amp;y={$map.y-50}"><img src="{$config.cdn}/graphic/map/map_s.png" style="z-index:1; position:relative;" /></a></div></th>
						<th></th>
					</tr>
				</table>
				<table class="vis" style="border: 1px solid #804000; margin-top:5px;" align="center" width="100%">
					<tr><th colspan="4">Jogadores marcados:</th></tr>
					<tr class="nowrap">
						{foreach from=$marked item=mark}
						{if $mark.i%2==0}</tr><tr>{/if}
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb({$mark.color})"></th>
						<td style="white-space:normal;"><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$mark.marked_id}">{$mark.name}</a></td>
						{/foreach}
						{if empty($marked)}<tr><td colspan="8"><div class="error">Nenhuma marcação encontrada!</div></td></tr>{/if}
					</tr>
					<tr><th colspan="8"><a href="game.php?village={$village.id}&amp;screen=map&amp;page=mark">&raquo; Gerenciar marcações</a></th></tr>
				</table>
			</td>
		</tr>
	</table>
{/if}
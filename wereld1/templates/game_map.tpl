{if $page == 'mark'}
	{include file='game_map_mark.tpl'}
{else}
	<div id="info" style="position:absolute; top:0px; left:0px; width:350px; height:1px; visibility: hidden; z-index:10"></div>
	<h2>Continent {$continent}</h2>
	<table collspacing="0" collpadding="0" width="100%">
		<tr>
			<td valign="top">
				<table class="vis" style="border: 1px solid #804000; margin-bottom:5px;" align="center">
					<tr class="nowrap">
						<th valign="top">Standard:</th>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(255,255,255)"></th>
						<td style="white-space:normal"> Current village</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(240,200,0)"></th>
						<td style="white-space:normal; width:100px;"> Your villages</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(0,0,244)"></th>
						<td style="white-space:normal"> Your tribe</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(150,150,150)"></th>
						<td style="white-space:normal"> Barbarian villages</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(130,60,10)"></th>
						<td style="white-space:normal"> Other villages</td>
					</tr>
					<tr class="nowrap">
						<th valign="top">Tribe:</th>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(0,160,244)"></th>
						<td style="white-space:normal;"> Allies</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(128,0,128)"></th>
						<td style="white-space:normal;" colspan="3"> Non-aggression pacts (NAP)</td>
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb(244,0,0)"></th>
						<td style="white-space:normal" colspan="3"> Enemies</td>
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

												<td id="tile_{$x}_{$y}" class="{$cl_map->getClass($x,$y)}" style="background-color:rgb({$cl_map->getColor($x,$y)})"><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$cl_map->getvillageid($x,$y)}"><img src="{$config.cdn}/graphic/{$map_base}/{$cl_map->graphic($x,$y)}" onmouseover="showinfo({$cl_map->getvillageid($x,$y)}, {$user.id}, {$village.x}, {$village.y});" onmouseout="hideinfo();" alt="" /></a></td>



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
					<tr><th colspan="3">Center map</th></tr>
					<tr>
						<form style="text-align:center;" action="game.php?village={$village.id}&amp;screen=map" method="post">
							<td>X: <input type="text" class="datax" name="x" maxlength="3" size="3" id="inputx" value="{$map.x}" onkeyup="xProcess('inputx', 'inputy')" /></td>
							<td>Y: <input type="text" class="datay" name="y" maxlength="3" size="3" id="inputy" value="{$map.y}" ></td>
							<td><input type="submit" class="button" name="go" value="OK" /></td>
						</form>
					</tr>
				</table>
				<table cellspacing="0" cellpadding="0" class="map_container minimap_container" style="border: 1px solid #804000; border-spacing: 0; margin: 0 auto;" width="77%">
					<tr>
						<td align="center" width="28"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x-50}&amp;y={$map.y+50}"><img src="{$config.cdn}/graphic/map/map_nw.png" style="z-index:1; position:relative;" alt="North west" /></a></td>
						<td align="center"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x}&amp;y={$map.y+50}"><img src="{$config.cdn}/graphic/map/map_n.png" style="z-index:1; position:relative;" alt="North" /></a></td>
						<td align="center" width="28"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x+50}&amp;y={$map.y+50}"><img src="{$config.cdn}/graphic/map/map_ne.png" style="z-index:1; position:relative;" alt="North east" /></a></td>
					</tr>
					<tr>
						<td align="center" valign="middle" style="vertical-align:middle;" width="28"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x-50}&amp;y={$map.y}"><img src="{$config.cdn}/graphic/map/map_w.png" style="z-index:1; position:relative;" alt="West" /></a></td>
						<td style="padding: 0" align="center">
							<div id="minimap" data-cx="{$map.x}" data-cy="{$map.y}" data-village="{$village.id}" style="overflow:hidden; position:relative; padding:0px; width:267px; height:267px; cursor:crosshair;">
								<img id="minimap_img" src="minimap.php?x={$map.x}&amp;y={$map.y}&amp;id={$village.id}&amp;hkey={$hkey}&amp;t={$smarty.now}" style="position:absolute; z-index:1; left:0; top:0; width:267px; height:267px;" alt="Minimap" />
								<div id="minimap_viewport" style="border: 1px solid #fff; position: absolute; z-index: 10; width: 45px; height: 45px; left: 110px; top: 110px;"></div>
							</div>
						</td>
						<td align="center" valign="middle" style="vertical-align:middle;" width="28"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x+50}&amp;y={$map.y}"><img src="{$config.cdn}/graphic/map/map_e.png" style="z-index:1; position:relative;" alt="East" /></a></td>
					</tr>
					<tr>
						<td align="center" width="28"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x-50}&amp;y={$map.y-50}"><img src="{$config.cdn}/graphic/map/map_sw.png" style="z-index:1; position:relative;" alt="South west" /></a></td>
						<td align="center"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x}&amp;y={$map.y-50}"><img src="{$config.cdn}/graphic/map/map_s.png" style="z-index:1; position:relative;" alt="South" /></a></td>
						<td align="center" width="28"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$map.x+50}&amp;y={$map.y-50}"><img src="{$config.cdn}/graphic/map/map_se.png" style="z-index:1; position:relative;" alt="South east" /></a></td>
					</tr>
				</table>
				{literal}
				<script type="text/javascript">
				(function() {
					var minimap = document.getElementById('minimap');
					if (!minimap) return;
					minimap.onclick = function(e) {
						e = e || window.event;
						var rect = minimap.getBoundingClientRect();
						var px = (e.clientX || 0) - rect.left;
						var py = (e.clientY || 0) - rect.top;
						var cx = parseInt(minimap.getAttribute('data-cx'), 10) || 0;
						var cy = parseInt(minimap.getAttribute('data-cy'), 10) || 0;
						var villageId = minimap.getAttribute('data-village') || 0;
						var nx = cx + Math.round((px - 133) / 5);
						var ny = cy - Math.round((py - 133) / 5);
						if (nx < 0) nx = 0;
						if (ny < 0) ny = 0;
						if (nx > 999) nx = 999;
						if (ny > 999) ny = 999;
						window.location.href = 'game.php?village=' + villageId + '&screen=map&x=' + nx + '&y=' + ny;
					};
				})();
				</script>
				{/literal}
				<table class="vis" style="border: 1px solid #804000; margin-top:5px;" align="center" width="100%">
					<tr><th colspan="4">Marked players:</th></tr>
					<tr class="nowrap">
						{foreach from=$marked item=mark}
						{if $mark.i%2==0}</tr><tr>{/if}
						<th style="background-image: none; width:15px; padding:0px; background-color:rgb({$mark.color})"></th>
						<td style="white-space:normal;"><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$mark.marked_id}">{$mark.name}</a></td>
						{/foreach}
						{if empty($marked)}<tr><td colspan="8"><div class="error">No map marks found!</div></td></tr>{/if}
					</tr>
					<tr><th colspan="8"><a href="game.php?village={$village.id}&amp;screen=map&amp;page=mark">&raquo; Manage map marks</a></th></tr>
				</table>
			</td>
		</tr>
	</table>
{/if}
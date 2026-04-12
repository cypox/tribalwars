{if !empty($error)}<div class="error">{$error}</div>{/if}
<table class="vis">
	<tr>
		<th>Mercadores: {$inside_dealers}/{$max_dealers}</th>
		<th>Transporte máximo: {math equation="x * 1000" x=$inside_dealers}</th>
	</tr>
</table><br />
<form action="game.php?village={$village.id}&amp;screen=market&amp;try=confirm_send" method="post" name="market">
	<table>
		<tr>
			<td valign="top">
				<table class="vis">
					<tr>
						<th>Recursos</th>
					</tr>
					<tr>
						<td>
							<img src="{$config.cdn}/graphic/icons/wood.png" title="Madeira" alt="" />
							<input name="wood" type="text" value="" size="5" tabindex="1" id="input_wood" />
							&nbsp;
							<a href="javascript:void(0);" onclick="insertUnit($('#input_wood'), {$max.wood})">({$max.wood})</a>
						</td>
					</tr>
					<tr>
						<td>
							<img src="{$config.cdn}/graphic/icons/stone.png" title="Argila" alt="" />
							<input name="stone" type="text" value="" size="5" tabindex="2" id="input_stone" />
							&nbsp;
							<a href="javascript:void(0);" onclick="insertUnit($('#input_stone'), {$max.stone})">({$max.stone})</a>
						</td>
					</tr>
					<tr>
						<td>
							<img src="{$config.cdn}/graphic/icons/iron.png" title="Ferro" alt="" />
							<input name="iron" type="text" value="" size="5" tabindex="3" id="input_iron" />
							&nbsp;
							<a href="javascript:void(0);" onclick="insertUnit($('#input_iron'), {$max.iron})">({$max.iron})</a>
						</td>
					</tr>
				</table>
			</td>
			<td valign="top">
				<table class="vis">
					<tr>
						<th colspan="3">Destino</th>
					</tr>
					<tr>
						<td>
							<label for="x">x:</label>
							<input type="text" name="x" id="inputx" value="" size="5" tabindex="4" onkeyup="xProcess('inputx', 'inputy')" />
							<label for="y">y:</label>
							<input type="text" name="y" id="inputy" value="" size="5" tabindex="5"/>
						</td>
						<td>
						{if count($villages)>0}
							<select name="target" size="1" onchange="insertCoord(document.forms[0], this)">
								<option>&gt; Suas aldeias &lt;</option>
								{foreach from=$villages key=id item=value}
									<option value="{$villages.$id.x}|{$villages.$id.y}">{$villages.$id.name} ({$villages.$id.x}|{$villages.$id.y}) K{$villages.$id.continent}</option>
								{/foreach}
							</select>
						{/if}
						</td>
					</tr>
				</table>
				<input type="submit" value="OK" tabindex="8" class="button" />
			</td>
		</tr>
	</table>
</form>
{if count($own) > 0}
<h3>Seus transportes</h3>
<table class="vis" width="100%">
	<tr>
		<th width="180">Destino</th>
		<th width="80">Recursos</th>
		<th width="65">Mercadores</th>
		<th width="70">Duração</th>
		<th width="100">Chegada</th>
		<th width="70">Chegada em</th>
	</tr>
	{foreach from=$own item=arr key=id}
	<tr>
		<td>{if $arr.type=='to'}Transporte à {else}Retorno de {/if}<br /><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$arr.villageid}">{$arr.villagename}</a></td>
		<td>{if $arr.wood > 0}<img src="{$config.cdn}/graphic/icons/wood.png" title="Madeira" alt="" />{$arr.wood} {/if}{if $arr.stone > 0}<img src="{$config.cdn}/graphic/icons/stone.png" title="Argila" alt="" />{$arr.stone} {/if}{if $arr.iron > 0}<img src="{$config.cdn}/graphic/icons/iron.png" title="Ferro" alt="" />{$arr.iron} {/if}</td>
		<td>{$arr.dealers}</td>
		<td>{$arr.duration}</td>
		<td>{$arr.arrival}</td>
		<td>{if $arr.arrival_in_sek < 0}{$arr.arrival_in+1}{else}<span class="timer">{$arr.arrival_in}</span>{/if}</td>
		{if $arr.can_cancel}
		<td><a href="game.php?village={$village.id}&amp;screen=market&amp;mode=send&amp;action=cancel&amp;id={$id}&amp;h={$hkey}">Cancelar</a></td>
		{/if}
	</tr>
	{/foreach}
</table>
{/if}
{if count($others) > 0}
<h3>Transportes em chegada</h3>
<table class="vis" width="100%">
	<tr>
		<th width="160">Origem</th>
		{if $others_see_ress}
		<th width="80">Mercadores</th>
		{/if}
		<th width="100">Chegada</th>
		<th width="70">Chegada em</th>
	</tr>
		{foreach from=$others item=arr key=id}
			<tr>
			<td><a href="game.php?village={$village.id}&amp;screen=info_village&amp;id={$arr.villageid}">{$arr.villagename}</a></td>
			{if $arr.see_ress}
			<td>{if $arr.wood > 0}<img src="{$config.cdn}/graphic/icons/wood.png" title="Madeira" alt="" />{$arr.wood} {/if}{if $arr.stone > 0}<img src="{$config.cdn}/graphic/icons/stone.png" title="Argila" alt="" />{$arr.stone} {/if}{if $arr.iron > 0}<img src="{$config.cdn}/graphic/icons/iron.png" title="Ferro" alt="" />{$arr.iron} {/if}</td>
			{else}
				{if $others_see_ress}
			<td></td>
				{/if}
			{/if}
			<td>{$arr.arrival}</td>
			<td>{if $arr.arrival_in_sek < 0}{$arr.arrival_in}{else}<span class="timer">{$arr.arrival_in}</span>{/if}</td>
			</tr>
		{/foreach}
	</table>
{/if}
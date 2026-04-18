{if !empty($error)}<div class="error">{$error}</div>{/if}
<table class="vis">
	<tr>
		<th>Merchants: {$inside_dealers}/{$max_dealers}</th>
		<th>Maximum transport: {math equation="x * 1000" x=$inside_dealers}</th>
	</tr>
</table>
<h3>Create offer</h3>
<form action="game.php?village={$village.id}&amp;screen=market&amp;mode=own_offer&amp;action=new_offer&amp;h={$hkey}" method="post">
	<table class="vis">
		<tr>
			<td width="150">I offer:</td>
			<td align="center"><input name="sell" type="text" size="7" value="" /></td>
			<td align="center">
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td><input id="res_sell_wood" name="res_sell" type="radio" value="wood" /></td>
						<td width="30"><label for="res_sell_wood"><img src="{$config.cdn}/graphic/icons/wood.png" title="Wood" alt="" /></label></td>
						<td><input id="res_sell_stone" name="res_sell" type="radio" value="stone" /></td>
						<td width="30"><label for="res_sell_stone"><img src="{$config.cdn}/graphic/icons/stone.png" title="Clay" alt="" /></label></td>
						<td><input id="res_sell_iron" name="res_sell" type="radio" value="iron" /></td>
						<td width="30"><label for="res_sell_iron"><img src="{$config.cdn}/graphic/icons/iron.png" title="Iron" alt="" /></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>I want:</td>
			<td align="center"><input name="buy" type="text" size="7" value="" /></td>
			<td align="center">
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td><input id="res_buy_wood" name="res_buy" type="radio" value="wood" /></td>
						<td width="30"><label for="res_buy_wood"><img src="{$config.cdn}/graphic/icons/wood.png" title="Wood" alt="" /></label></td>
						<td><input id="res_buy_stone" name="res_buy" type="radio" value="stone" /></td>
						<td width="30"><label for="res_buy_stone"><img src="{$config.cdn}/graphic/icons/stone.png" title="Clay" alt="" /></label></td>
						<td><input id="res_buy_iron" name="res_buy" type="radio" value="iron" /></td>
						<td width="30"><label for="res_buy_iron"><img src="{$config.cdn}/graphic/icons/iron.png" title="Iron" alt="" /></label></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>Number of offers:</td>
			<td align="center"><input name="multi" type="text" size="7" value="1" /></td>
			<td>offer(s)</td>
		</tr>
		<tr><th colspan="3"><span style="float:right;"><input type="submit" value="Create" class="button" /></span></th></tr>
	</table>
</form>
{if count($offers)>0}
<h3>Your offers</h3>
<form action="game.php?village={$village.id}&amp;screen=market&amp;mode=own_offer&amp;action=modify_offers&amp;h={$hkey}" method="post">
	<table class="vis">
		<tr>
			<th>I offer</th>
			<th>I want</th>
			<th>Offers</th>
			<th>Added on</th>
		</tr>
		{foreach from=$offers item=arr key=id}
		<tr>
			<td><input name="id_{$id}" type="checkbox" />{if $arr.sell_ress=='wood'}<img src="{$config.cdn}/graphic/icons/wood.png" title="Wood" alt="" />{/if}{if $arr.sell_ress=='stone'}<img src="{$config.cdn}/graphic/icons/stone.png" title="Clay" alt="" />{/if}{if $arr.sell_ress=='iron'}<img src="{$config.cdn}/graphic/icons/iron.png" title="Iron" alt="" />{/if} {$arr.sell}</td>
			<td>{if $arr.buy_ress=='wood'}<img src="{$config.cdn}/graphic/icons/wood.png" title="Wood" alt="" />{/if}{if $arr.buy_ress=='stone'}<img src="{$config.cdn}/graphic/icons/stone.png" title="Clay" alt="" />{/if}{if $arr.buy_ress=='iron'}<img src="{$config.cdn}/graphic/icons/iron.png" title="Iron" alt="" />{/if} {$arr.buy}</td>
			<td align="center">{$arr.multi}</td>	
			<td align="center">{$arr.time}</td>
		</tr>
		{/foreach}
		<tr><th colspan="4"><input name="all" type="checkbox" onclick="selectAll(this.form, this.checked)" /> Select all</th></tr>
	</table><br />
	<center>
		<input type="submit" value="Delete" class="button" name="delete" />
		<input type="text" size="2" name="mod_count" value="1" style="text-align:center;" />
		<input type="submit" value="Add offer" class="button green" name="increase" />
		<input type="submit" value="Reduce offer" class="button red" name="decrease" />
	</center>
</form>
{/if}
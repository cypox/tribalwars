{if !empty($error)}<div class="error">{$error}</div>{/if}
<table class="vis">
	<tr>
		<th>Merchants: {$inside_dealers}/{$max_dealers}</th>
		<th>Maximum transport: {math equation="x * 1000" x=$inside_dealers}</th>
	</tr>
</table>
<h3>Search offers</h3>
<form action="game.php?village={$village.id}&amp;screen=market&amp;mode=other_offer&amp;action=search&amp;h={$hkey}" method="post">
	<table class="vis">
		<tr>
			<td>I want:</td>
			<td>
				<select name="res_sell">
					<option value="all" {if $market.market_sell=='all'}selected="selected"{/if}>All</option>
					<option value="wood" {if $market.market_sell=='wood'}selected="selected"{/if}>Wood</option>
					<option value="stone" {if $market.market_sell=='stone'}selected="selected"{/if}>Clay</option>
					<option value="iron" {if $market.market_sell=='iron'}selected="selected"{/if}>Iron</option>
				</select>
			</td>
			<td width="100">Maximum ratio:</td>
			<td><input name="ratio_max" value="{$market.market_ratio_max}" type="text" size="4" /> (Ex: 1.8)</td>
		</tr>
		<tr>
			<td>I offer:</td>
			<td><select name="res_buy">
				<option value="all" {if $market.market_buy=='all'}selected="selected"{/if}>All</option>
				<option value="wood" {if $market.market_buy=='wood'}selected="selected"{/if}>Wood</option>
				<option value="stone" {if $market.market_buy=='stone'}selected="selected"{/if}>Clay</option>
				<option value="iron" {if $market.market_buy=='iron'}selected="selected"{/if}>Iron</option>
			</select></td>
			<td colspan="2" align="center"><input type="submit" class="button" value="Search" /></td>
		</tr>
	</table><br />
</form>
{if $num_pages>1}
<table class="vis">
	<tr>
		<td align="center">
		{section name=countpage start=1 loop=$num_pages+1 step=1}
			{if $site==$smarty.section.countpage.index}
			<strong>&gt;{$smarty.section.countpage.index}&lt;</strong>
			{else}
			<a href="game.php?village={$village.id}&amp;screen=market&amp;mode=other_offer&amp;site={$smarty.section.countpage.index}">[{$smarty.section.countpage.index}]</a>
			{/if}
		{/section}
		</td>
	</tr>
</table><br />
{/if}
<table class="vis">
	<tr>
		<th>I offer</th>
		<th>I want</th>
		<th>Player</th>
		<th>Duration</th>
		<th>Ratio</th>
		<th>Offers</th>
	</tr>
	{foreach from=$offers item=arr key=id}
	<tr>
		<td>{if $arr.sell_ress=='wood'}<img src="{$config.cdn}/graphic/icons/wood.png" title="Wood" alt="" />{/if}{if $arr.sell_ress=='stone'}<img src="{$config.cdn}/graphic/icons/stone.png" title="Clay" alt="" />{/if}{if $arr.sell_ress=='iron'}<img src="{$config.cdn}/graphic/icons/iron.png" title="Iron" alt="" />{/if} {$arr.sell}</td>
		<td>{if $arr.buy_ress=='wood'}<img src="{$config.cdn}/graphic/icons/wood.png" title="Wood" alt="" />{/if}{if $arr.buy_ress=='stone'}<img src="{$config.cdn}/graphic/icons/stone.png" title="Clay" alt="" />{/if}{if $arr.buy_ress=='iron'}<img src="{$config.cdn}/graphic/icons/iron.png" title="Iron" alt="" />{/if} {$arr.buy}</td>
		<td align="center"><a href="game.php?village=820&amp;screen=info_player&amp;id={$arr.userid}">{$arr.username}</a></td>
		<td align="center">{$arr.unit_running}</td>
		<td align="center"><table width="40"><tr><td style="background-color:rgb({$arr.ratio_red}, {$arr.ratio_green}, 100); color:#000000; text-align:center;">{$arr.ratio_max}</td></tr></table></td>
		<td align="center">{$arr.multi} offer(s)</td>
		<td align="center">
		{if $arr.message=='not_enough_dealers'}
			Not enough merchants.
		{elseif $arr.message=='not_enough_ress'}
			Not enough resources.
		{else}
			<form action="game.php?village={$village.id}&amp;screen=market&amp;mode=other_offer&amp;action=accept_multi&amp;id={$id}&amp;site={$site}&amp;h={$hkey}" method="post">
				<input type="text" name="count" size="3" value="1" onclick="javascript:this.value=''" />
				<input type="submit" class="button" value="Accept" size="5" />
			</form>						
		{/if}
		</td>
	</tr>
	{/foreach}
</table>
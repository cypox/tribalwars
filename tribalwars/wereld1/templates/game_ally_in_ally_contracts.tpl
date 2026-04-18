<p>On this page, relations with other tribes can be managed. These settings are <b>not</b> directly linked to game mechanics, but villages are colored on the map accordingly. This status is only visible to tribe members and can only be changed by Diplomats.</p>
<table class="vis" width="300">
	<tr><th colspan="2">Allies</th></tr>
	{foreach from=$contracts.partner item=partner}
	<tr>
		<td><a href="game.php?village={$village.id}&screen=info_ally&id={$partner.to_ally}">{$partner.short}</a></td>
		<td><a href="game.php?village={$village.id}&screen=ally&mode=contracts&action=cancel_contract&id={$partner.id}&hkey={$hkey}">terminate</a></td>
	</tr>
	{/foreach}
</table><br />
<table class="vis" width="300">
	<tr><th colspan="2">Non-aggression pacts (NAP)</th></tr>
	{foreach from=$contracts.nap item=partner}
	<tr>
		<td><a href="game.php?village={$village.id}&screen=info_ally&id={$partner.to_ally}">{$partner.short}</a></td>
		<td><a href="game.php?village={$village.id}&screen=ally&mode=contracts&action=cancel_contract&id={$partner.id}&hkey={$hkey}">terminate</a></td>
	</tr>
	{/foreach}
</table><br />
<table class="vis" width="300">
	<tr><th colspan="2">Enemies</th></tr>
	{foreach from=$contracts.enemy item=partner}
	<tr>
		<td><a href="game.php?village={$village.id}&screen=info_ally&id={$partner.to_ally}">{$partner.short}</a></td>
		<td><a href="game.php?village={$village.id}&screen=ally&mode=contracts&action=cancel_contract&id={$partner.id}&hkey={$hkey}">terminate</a></td>
	</tr>
	{/foreach}
</table><br />
<h3>Add diplomatic relation</h3>
<form method="post" action="/game.php?village={$village.id}&screen=ally&mode=contracts&action=add_contract&h=835c">
	Tribe (TAG):
	<input type="text" name="tag" maxlength="6" />
	<select name="type">
		<option value="partner">Ally</option>
		<option value="nap">Non-aggression pact (NAP)</option>
		<option value="enemy">Enemy</option>
	</select>
	<input type="submit" value="OK" class="button green" />
</form>
<h3>Urlaubsvertretung</h3>
<p>Hier kannst du eine Person bitten deinen Account zu verwalten, solange du im Urlaub bist. Dieser Spieler kann sich dann in deinen Account einloggen. Der Urlaubsvertreter kann nach 48 Stunden eine andere Person als Urlaubsvertreter einstellen. Während der Urlaubsmodus aktiv ist, kannst du nicht auf deinen Account zugreifen. Du kannst die Urlaubsvertretung aber jederzeit beenden.</p>

<p>Bis 24 Stunden nach Ende der Urlaubsvertretung dürfen keine spielerischen Aktionen zwischen Urlaubsaccount und Account der Urlaubsvertretung stattfinden. Insbesondere sind dies:</p>
<ul>
<li>Rohstofflieferungen</li>
<li>Gegenseitige Plünderungen</li>

<li>Koordinierte Angriffe beider Accounts</li>
<li>Schicken von Unterstützungstruppen</li>
</ul>
{if empty($user.vacation_name)}
	<form action="game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation&amp;action=sitter_offer&amp;h={$hkey}" method="post">
		<table class="vis">
		<tr>
			<th>Vertreter</th>
			<td><input name="sitter" type="text" /> <input type="submit" value="OK" /></td>
	
		</tr>
	    </table>
	</form>
{else}
	{if $sid->is_vacation()}
		<p>
		<a href="javascript:ask('Urlaubsvertretung wirklich beenden? Du hast dann sofort keinen Zugriff mehr auf diesen Account', 'game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation&amp;action=end_vacation&amp;h={$hkey}')">Urlaubsvertretung beenden</a>
		</p>
	{else}
		<table class="vis">
		<tr>
			<td>Anfrage an:</td>
			<td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$user.vacation_id}">{$user.vacation_name}</a></td>
			<td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation&amp;action=sitter_offer_cancel&amp;h={$hkey}">&raquo; Anfrage zurückziehen</a></td>
		</tr>
		</table>
	{/if}
{/if}

{if count($vacation_accept)>0 && !$sid->is_vacation()}
	<h3>Eigene Urlaubsvertretungen</h3>
	<p>Hier werden die Spieler angezeigt, für die du die Urlaubsvertretung übernimmst:</p>
	<table class="vis">
	<tr><th width="200">Spieler</th></tr>
	{foreach from=$vacation_accept item=arr key=id}
		<tr><td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$id}">{$arr.username}</a></td>
		<td><a href="login_uv.php?id={$id}" target="_blank">&raquo; einloggen</a></td>	</tr>
	{/foreach}
	</table>
{/if}

{if count($vacation)>0 && !$sid->is_vacation()}
	<h3>Anfragen</h3>
	<p>Hier werden die Spieler angezeigt, die dich um eine Urlaubsvertretung gebeten haben.</p>
	<table class="vis">
	<tr><th>Spieler</th><th colspan="2">Aktion</th></tr>
	{foreach from=$vacation item=arr key=id}
		<tr>
		<td width="200"><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$id}">{$arr.username}</a></td>
		<td width="100"><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation&amp;action=sitter_accept&amp;player_id={$id}&amp;h={$hkey}">annehmen</a></td>
		<td width="100"><a href="javascript:ask('Urlaubsvertretungs wirklich ablehnen?', 'game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation&amp;action=sitter_reject&amp;player_id={$id}&amp;h={$hkey}')">ablehnen</a></td>
		</tr>
	{/foreach}
{/if}
<h3>Absender blockieren</h3>
<p>Hier kannst du Spieler angeben, deren Nachrichten an dich blockiert werden.</p>
	
<form action="game.php?village={$village.id}&amp;screen=mail&amp;mode=block&amp;action=block_name&amp;h={$hkey}" method="post">
<table class="vis"><tr>
<td>Spieler:</td>
<td><input name="tribe_name" type="text" /></td>
<td><input type="submit" value="OK" /></td>
</tr></table>
</form>

{if count($blocked)>0}
	<h4>Blockierte Spieler</h4>
	<table class="vis">
	<tr><th width="200">Name</th><th width="100">Entsperren</th></tr>
		{foreach from=$blocked item=arr key=id}
			<tr>
			<td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$arr.blocked_id}">{$arr.blocked_name}</a></td>
			<td><a href="game.php?village={$village.id}&amp;screen=mail&amp;mode=block&amp;action=unblock&amp;from_id={$arr.blocked_id}&amp;h={$hkey}">entsperren</a></td>
			</tr>
		{/foreach}
	</table>
{/if}
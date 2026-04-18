<h3>Vacation mode</h3>
<p>Here you can ask another player to manage your account while you are away. This player can log into your account. After 48 hours, your sitter can set a different sitter. While vacation mode is active, you cannot access your account. You can end vacation mode at any time.</p>

<p>For up to 24 hours after vacation mode ends, no game actions may occur between the vacation account and the sitter account. This includes:</p>
<ul>
<li>Resource transports</li>
<li>Mutual farming attacks</li>

<li>Coordinated attacks from both accounts</li>
<li>Sending support troops</li>
</ul>
{if empty($user.vacation_name)}
	<form action="game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation&amp;action=sitter_offer&amp;h={$hkey}" method="post">
		<table class="vis">
		<tr>
			<th>Sitter</th>
			<td><input name="sitter" type="text" /> <input type="submit" value="OK" /></td>
	
		</tr>
	    </table>
	</form>
{else}
	{if $sid->is_vacation()}
		<p>
		<a href="javascript:ask('End vacation mode now? You will immediately lose access to this account.', 'game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation&amp;action=end_vacation&amp;h={$hkey}')">End vacation mode</a>
		</p>
	{else}
		<table class="vis">
		<tr>
			<td>Request to:</td>
			<td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$user.vacation_id}">{$user.vacation_name}</a></td>
			<td><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation&amp;action=sitter_offer_cancel&amp;h={$hkey}">&raquo; Withdraw request</a></td>
		</tr>
		</table>
	{/if}
{/if}

{if count($vacation_accept)>0 && !$sid->is_vacation()}
	<h3>Your sitter assignments</h3>
	<p>Players shown here are accounts you currently sit for:</p>
	<table class="vis">
	<tr><th width="200">Player</th></tr>
	{foreach from=$vacation_accept item=arr key=id}
		<tr><td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$id}">{$arr.username}</a></td>
		<td><a href="login_uv.php?id={$id}" target="_blank">&raquo; Login</a></td>	</tr>
	{/foreach}
	</table>
{/if}

{if count($vacation)>0 && !$sid->is_vacation()}
	<h3>Requests</h3>
	<p>Players shown here have asked you to be their sitter.</p>
	<table class="vis">
	<tr><th>Player</th><th colspan="2">Action</th></tr>
	{foreach from=$vacation item=arr key=id}
		<tr>
		<td width="200"><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$id}">{$arr.username}</a></td>
		<td width="100"><a href="game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation&amp;action=sitter_accept&amp;player_id={$id}&amp;h={$hkey}">Accept</a></td>
		<td width="100"><a href="javascript:ask('Reject this vacation request?', 'game.php?village={$village.id}&amp;screen=settings&amp;mode=vacation&amp;action=sitter_reject&amp;player_id={$id}&amp;h={$hkey}')">Reject</a></td>
		</tr>
	{/foreach}
{/if}
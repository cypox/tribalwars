{if !empty($error)}<div class="error">{$error}</div>{/if}
<h2>Friends</h2>
<p>Here you can manage your friends list and see which friends are currently online. Only add players you trust, since they can also see your online status. This information can be very valuable to enemies.</p>

{if count($friends.activ) != 0}
<h3 style="margin-bottom:5px;">My friends</h3> 
<table class="vis" style="width:300px;">
	<tr>
		<th width="150" colspan="2">Player</th>
		<th width="100">Status</th> 
	</tr>
	{foreach from=$friends.activ item=friend}
	<tr>
		<td width="10"><a href="game.php?village{$village.id}&amp;screen=friends&amp;action=delete_buddy&amp;id={$friend.id}" onclick="return confirm('Are you sure you want to remove this player from your friends list?')"><img src="../graphic/icons/delete.png" /></a></td>
		<td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$friend.uid}">{$friend.name}</a></td>
		{if $friend.status}
		<td style="background-color:green; text-align:center; color:white; font-weight:bold;">ONLINE</td>
		{else}
		<td style="background-color:red; text-align:center; color:white; font-weight:bold;">OFFLINE</td>
		{/if}
	</tr>
	{/foreach}
</table><br />
{/if}
{if count($friends.pending) != 0}
<h3>Sent requests</h3> 
<table class="vis" style="width:300px;">
	<tr>
		<th>Player</th>
		<th>Action</th>
	</tr>
	{foreach from=$friends.pending item=friend}
	<tr> 
		<td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$friend.uid}">{$friend.name}</a></td> 
		<td><a href="game.php?village={$village.id}&amp;screen=friends&amp;action=cancel_buddy&amp;id={$friend.id}" onclick="return confirm('Are you sure you want to cancel this invitation?')">cancel</a></td> 
	</tr> 
	{/foreach}
</table><br />
{/if}
{if count($friends.request) != 0}
<h3>Incoming requests</h3> 
<table class="vis" style="width:300px;">
	<tr>
		<th>Player</th>
		<th colspan="2">Action</th>
	</tr>
	{foreach from=$friends.request item=friend}
	<tr> 
		<td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$friend.uid}">{$friend.name}</a></td> 
		<td><a href="game.php?village={$village.id}&amp;screen=friends&amp;action=approve_buddy&amp;id={$friend.id}" onclick="return confirm('Are you sure you want to accept this invitation?')">accept</a></td> 
		<td><a href="game.php?village={$village.id}&amp;screen=friends&amp;action=reject_buddy&amp;id={$friend.id}" onclick="return confirm('Are you sure you want to reject this invitation?')">reject</a></td> 
	</tr>
	{/foreach}
</table><br />
{/if}
<h3>Add friend</h3>
<table>
	<tr>
		<td>
			<form action="game.php?village={$village.id}&amp;screen=friends&amp;action=add_buddy&amp;h={$hkey}" method="post">
				<input name="name" type="text" /><input type="submit" value="OK" class="button" />
			</form>
		</td>
	</tr>
</table>
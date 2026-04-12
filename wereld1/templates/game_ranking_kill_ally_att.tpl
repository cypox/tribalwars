<table class="vis">
<tr>
	<th width="60">Rang</th>
	<th width="160">Name</th>
	<th width="100">Besiegt</th>
</tr>
	{foreach from=$ranks item=item key=id}
		<tr {$ranks.$id.mark}>
			<td>{$ranks.$id.rang}</td>
			<td><a href="game.php?village={$village.id}&screen=info_player&id={$id}">{$ranks.$id.short}</a></td>
			<td>{$ranks.$id.killed_units}</td>
		</tr>
	{/foreach}
</table>

<table class="vis" width="100%"><tr>
{if $site!=1}
	<td align="center">
	<a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode=kill_ally&amp;type={$type}&amp;site={$site-1}">&lt;&lt;&lt; nach oben</a></td>
{/if}
<td align="center">
<a href="game.php?village={$village.id}&amp;screen=ranking&amp;mode=kill_ally&amp;type={$type}&amp;site={$site+1}">nach unten &gt;&gt;&gt;</a></td>
</tr></table>
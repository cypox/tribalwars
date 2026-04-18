{if $screen != 'ally'}<h2 style="font-size:20px; font-weight:bold; text-transform:uppercase; margin-bottom:0px;">{$info.name}</h2>{/if}
<table width="100%">
	<tr>
		<td valign="top" width="50%">
			<table class="vis" width="100%" style="border:1px solid #804000">
				<tr><th colspan="2">Properties</th></tr>
				<tr><td width="150">Name:</td><td>{$info.name}</td></tr>
				<tr><td>Tag:</td><td>{$info.short}</td></tr>
				<tr><td>Members:</td><td>{$info.members}</td></tr>
				<tr><td>Total points:</td><td>{$info.points|format_number}</td></tr>
				<tr><td>Average points:</td><td>{$info.cutthroungt|format_number}</td></tr>
				<tr><td>Rank:</td><td>{$info.rank}</td></tr>
				<tr><th colspan="2"><a href="game.php?village={$village.id}&amp;screen=info_member&amp;id={$info.id}">&raquo; Members</a></th></tr>
			</table>
		</td>
		<td valign="top" width="50%">
			<table class="vis" width="100%" style="border:1px solid #804000;">
				{if !empty($info.image)}
				<tr><td align="center"><img src="{$config.cdn}/graphic/ally/{$info.image}"></td></tr>
				{/if}
				<tr><th>Tribe profile</th></tr>
				<tr><td align="center">{$info.description}</td></tr>
			</table>
		</td>
	</tr>
</table>
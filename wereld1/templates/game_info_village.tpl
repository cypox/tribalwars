<h2 style="margin-bottom:0px;">{$info_village.name}</h2>
<table width="100%">
	<tr>
		<td valign="top" width="40%">
			<table class="vis" width="100%" style="border:1px solid #804000;">
				<tr><th colspan="2">{$info_village.name}</th></tr>
				<tr><td width="80">Coordenadas:</td><td>{$info_village.x}|{$info_village.y}</td></tr>
				<tr><td>Pontos:</td><td width="180">{$info_village.points|format_number}</td></tr>
				{if empty($info_user.username)}
				<tr><td>Jugador:</td><td>--</td></tr>
				{else}
				<tr><td>Jugador:</td><td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$info_village.userid}">{$info_user.username}</a></td></tr>
				{/if}
				{if !empty($info_ally.short)}
				<tr><td>Tribo:</td><td><a href="game.php?village={$village.id}&amp;screen=info_ally&amp;id={$info_ally.id}">{$info_ally.short}</a></td></tr>
				{/if}
				<tr><td colspan="2"><a href="game.php?village={$village.id}&amp;screen=map&amp;x={$info_village.x}&amp;y={$info_village.y}">&raquo; Centralizar no mapa</a></th></tr>
				<tr><td colspan="2"><a href="game.php?village={$village.id}&amp;screen=place&amp;mode=command&amp;target={$info_village.id}">&raquo; Enviar tropas</a></th></tr>
				{if $can_send_ress}
				<tr><td colspan="2"><a href="game.php?village={$village.id}&amp;screen=market&amp;mode=send&amp;target={$info_village.id}">&raquo; Enviar recursos</a></th></tr>
				{/if}
				{if $user.id==$info_village.userid}
				<tr><td colspan="2"><a href="game.php?village={$info_village.id}&amp;screen=overview">&raquo; Visualiza&ccedil;&atilde;o geral da aldeia</a></th></tr>
				{/if}
			</table>
		</td>
		<td valign="top" width="60%">&nbsp;</td>
	</tr>
</table>
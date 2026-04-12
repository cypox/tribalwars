{if !empty($error)}<div class="error">{$error}</div>{/if}
<h2>Amigos</h2>
<p>Aqui você pode administrar a sua lista de amigos, assim como ver quais amigos estão no momento online. Adicione à lista de amigos apenas jogadores de sua confiança, já que eles também poderão ver o seu status online. Esta informação pode ser de grande valor para inimigos.</p>

{if count($friends.activ) != 0}
<h3 style="margin-bottom:5px;">Meus amigos</h3> 
<table class="vis" style="width:300px;">
	<tr>
		<th width="150" colspan="2">Jogador</th>
		<th width="100">Status</th> 
	</tr>
	{foreach from=$friends.activ item=friend}
	<tr>
		<td width="10"><a href="game.php?village{$village.id}&amp;screen=friends&amp;action=delete_buddy&amp;id={$friend.id}" onclick="return confirm('Certeza que gostaria de remover este jogador da lista de amigos?')"><img src="../graphic/icons/delete.png" /></a></td>
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
		<th>Jogador</th>
		<th>Ação</th>
	</tr>
	{foreach from=$friends.pending item=friend}
	<tr> 
		<td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$friend.uid}">{$friend.name}</a></td> 
		<td><a href="game.php?village={$village.id}&amp;screen=friends&amp;action=cancel_buddy&amp;id={$friend.id}" onclick="return confirm('Certeza que gostaria de cancelar este convite?')">cancelar</a></td> 
	</tr> 
	{/foreach}
</table><br />
{/if}
{if count($friends.request) != 0}
<h3>Incoming requests</h3> 
<table class="vis" style="width:300px;">
	<tr>
		<th>Jogador</th>
		<th colspan="2">Ação</th>
	</tr>
	{foreach from=$friends.request item=friend}
	<tr> 
		<td><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$friend.uid}">{$friend.name}</a></td> 
		<td><a href="game.php?village={$village.id}&amp;screen=friends&amp;action=approve_buddy&amp;id={$friend.id}" onclick="return confirm('Certeza que gostaria de aceitar este convite?')">aceitar</a></td> 
		<td><a href="game.php?village={$village.id}&amp;screen=friends&amp;action=reject_buddy&amp;id={$friend.id}" onclick="return confirm('Certeza que gostaria de rejeitar este convite?')">recusar</a></td> 
	</tr>
	{/foreach}
</table><br />
{/if}
<h3>Adicionar amigo</h3>
<table>
	<tr>
		<td>
			<form action="game.php?village={$village.id}&amp;screen=friends&amp;action=add_buddy&amp;h={$hkey}" method="post">
				<input name="name" type="text" /><input type="submit" value="OK" class="button" />
			</form>
		</td>
	</tr>
</table>
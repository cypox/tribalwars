<h3>Barra de atalhos</h3>
{if $amount != 0}
<table class="vis" width="50%">
	<tr><th>Atalho</th><th>Ação</th></tr>
	{foreach from=$quickbar item=quick}
	<tr>
		<td>
		{if substr($quick.href, 0, 8) != 'game.php'}
			<a href="{$quick.href}"{if $quick.target != 0}target="_blank"{/if}><img src="{$quick.img}">{$quick.name}</a>
		{else}
			<a href="{$quick.href}&village={$quick.vid}"{if $quick.target != 0}target="_blank"{/if}><img src="{$quick.img}">{$quick.name}</a>
		{/if}
		</td>
		<td align="center"><a href="game.php?village={$quick.vid}&screen=settings&mode=quickbar&action=delete&id={$quick.id}&h={$hkey}">Apagar</a></td>
	{/foreach}
	</tr>
</table>
{/if}
<p><a href="game.php?village={$vill}&screen=settings&mode=quickbar&action=standard">&raquo; Carregar barra de atalhos padrão</a></p>
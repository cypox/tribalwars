<form method="post" action="game.php?village={$village.id}&screen=ally&mode=intro_igm&action=intro_igm&h={$hkey}">
	<table class="vis" align="center" width="100%" style="border:1px solid #804000">
		<tr><th>Mensagens de boas vindas:</th></tr>
		<tr><td><textarea name="text" cols="119" rows="10">{$ally.intro_igm}</textarea></td></tr>
		<tr><th><div align="right"><input type="submit" value="SALVAR" class="button" /></div></th></tr>
	</table>
</form>
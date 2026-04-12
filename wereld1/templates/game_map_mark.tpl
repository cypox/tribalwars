<script type="text/javascript" src="../js/jscolor.js"></script>
<table width="100%">
	<tr>
		<form action="game.php?village={$village.id}&amp;screen=map&amp;page=mark&amp;action=mark" method="post">
			<td valign="top" width="50%">
				<table class="vis" style="border: 1px solid #804000" align="center" width="100%">
					<tr><th colspan="3">Marcar jogador</th></tr>
					{if !empty($error)}<tr><td colspan="3"><div class="error">{$error}</div></td></tr>{/if}
					<tr>
						<td>&raquo; Jogador:</td>
						<td><input type="text" name="player" /></td>
						<th rowspan="2"><div align="center"><input type="submit" name="mark" value="OK" class="button" style="height:32px;width:50px;" /></div></th>
					</tr>
					<tr><td>&raquo; Cor:</td><td><input type="text" class="color" value="FF0000" maxlength="6" name="color" /></td></tr>
				</table>
			</td>
		</form>
		<td valign="top" width="50%">
			<table class="vis" style="border: 1px solid #804000;" align="center" width="100%">
				<tr><th colspan="6">Jogadores marcados:</th></tr>
				<tr class="nowrap">
					{foreach from=$marked item=mark}
					{if $mark.i%3==0}</tr><tr>{/if}
					<th style="background-image: none; width:15px; padding:0px; background-color:rgb({$mark.color})"></th>
					<td style="white-space:normal;"><a href="game.php?village={$village.id}&amp;screen=info_player&amp;id={$mark.marked_id}">{$mark.name}</a> <span style="float:right;"><a href="game.php?village={$village.id}&amp;screen=map&amp;page=mark&amp;action=delete&amp;id={$mark.marked_id}">[x]</a></span></td>
					{/foreach}
					{if empty($marked)}<tr><td colspan="8"><div class="error">Nenhuma marcação encontrada!</div></td></tr>{/if}
				</tr>
			</table>
		</td>
	</tr>
</table>
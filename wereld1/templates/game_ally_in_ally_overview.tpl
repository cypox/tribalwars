<table width="100%">
	<tr>
		<td valign="top" width="50%">
			<table class="vis" width="100%" style="border:1px solid #804000">
			{if $num_pages > 1}
				<tr>
					<td align="center" colspan="3">
					{section name=countpage start=1 loop=$num_pages+1 step=1}
						{if $site==$smarty.section.countpage.index}
						<strong> &gt;{$smarty.section.countpage.index}&lt; </strong>
						{else}
						<a href="game.php?village={$village.id}&amp;screen=ally&amp;site={$smarty.section.countpage.index}"> [{$smarty.section.countpage.index}] </a>
						{/if}
					{/section}
					</td>
				</tr>
			{/if}
				<tr>
					<th>Data</th>
					<th>Evento</th>
				</tr>
				{foreach from=$events item=arr key=id}
				<tr>
					<td>{$arr.time}</td>
					<td>{$arr.message}</td>
				</tr>
				{/foreach}
			</table>
		</td>
		<td valign="top" width="50%">
			<table class="vis" width="100%" style="border:1px solid #804000; border-bottom:none;">
				<tr><td><a href="game.php?village=36841&amp;screen=ally&amp;action=exit&amp;h=cc6f" onclick="javascript:ask('Você deseja realmente abandonar a tribo que faz parte?', 'game.php?village={$village.id}&amp;screen=ally&amp;action=exit&amp;h={$hkey}'); return false;">&raquo; deixar tribo</a></td></tr>
			</table>
			{if !empty($preview)}
			<table class="vis" width="100%" style="border:1px solid #804000; border-bottom:none;">
				<tr><th colspan="2">Visualizar</th></tr>
				<tr><td colspan="2" align="center">{$ally.intern_text}</td></tr>
			</table>
			{/if}
			<script type="text/javascript">
			function bbEdit() {ldelim}
				gid("edit_link").style.display = 'none';
				gid("edit_link_close").style.display = '';
				gid("show_row").style.display = 'none';
				gid("edit_row").style.display = '';
				gid("submit_row").style.display = '';
			{rdelim}
			function bbEdit_close() {ldelim}
				gid("edit_link").style.display = '';
				gid("edit_link_close").style.display = 'none';
				gid("show_row").style.display = '';
				gid("edit_row").style.display = 'none';
				gid("submit_row").style.display = 'none';
			{rdelim}
			</script>
			<form action="game.php?village={$village.id}&amp;screen=ally&amp;action=edit_intern&amp;h={$hkey}" method="post" name="edit_profile">
				<table class="vis" width="100%" style="border:1px solid #804000;">
					<tr><th colspan="2" width="100%">Quadro de anúncios {if $user.ally_found == '1'}<span style="float:right;"><a id="edit_link" href="javascript:bbEdit()" style="display:none"><span class="button">EDITAR</span></a><a id="edit_link_close" href="javascript:bbEdit_close()" style="display:none"><span class="button">CANCELAR</span></a></span>{/if}</th></tr>
					<tr id="show_row" align="center"><td colspan="2">{$ally.intern_text}</td></tr>
					{if $user.ally_found == '1'}
					<tr id="edit_row"><td colspan="2" align="center"><textarea name="intern" cols="56" rows="10">{$ally.edit_intern_text}</textarea></td></tr>
					<tr id="submit_row">
						<th><div align="right">
							<input type="submit" name="preview" value="VISUALIZAR" class="button" />
							<input type="submit" name="edit" value="SALVAR" class="button green" />
						</div></th>
					</tr>
					{/if}
				</table>
			</form>
			{if empty($preview)}
			<script type="text/javascript">
				gid("edit_row").style.display = 'none';
				gid("submit_row").style.display = 'none';
				gid("edit_link").style.display = '';
				gid("edit_link_close").style.display = 'none';
			</script>
			{else}
			<script type="text/javascript">
				gid("edit_row").style.display = '';
				gid("show_row").style.display = 'none';
				gid("submit_row").style.display = '';
				gid("edit_link").style.display = 'none';
				gid("edit_link_close").style.display = '';
			</script>
			{/if}
		</td>
	</tr>
</table>
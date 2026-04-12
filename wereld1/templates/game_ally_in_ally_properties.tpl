<table width="100%">
	<tr>
		<td valign="top" width="50%">
		{if $user.ally_found == '1'}
			<form action="game.php?village={$village.id}&amp;screen=ally&amp;mode=properties&amp;action=change&amp;h={$hkey}" method="post">
				<table class="vis" width="100%" style="border:1px solid #804000; border-bottom:none;">
					<tr><th colspan="2">Propriedades</th></tr>
					<tr><td>Nome:</td><td><input type="text" name="name" value="{$ally.name}" /></td></tr>
					<tr><td width="100">Abreviação:</td><td><input type="text" name="tag" maxlength="6" value="{$ally.short}" /><br /><b>máximo 6 caracteres</b></td></tr>
					<tr><td width="100">Homepage:</td><td><input type="text" name="homepage" maxlength="128" size="25"  value="{$ally.homepage}" /></td></tr>
					<tr><td width="100">Canal-IRC:</td><td><input type="text" name="irc-channel" maxlength="128" size="25"  value="{$ally.irc}" /></td></tr>
					<tr><th colspan="2"><div align="right"><input type="submit" value="SALVAR" class="button" /></div></th></tr>
				</table>
			</form>
			<table class="vis" width="100%" style="border:1px solid #804000;">
				<tr><th>Debandar tribo</th></tr>
				<tr><td><a href="javascript:ask('Willst du wirklich deinen Stamm aufl&ouml;sen?', 'game.php?village={$village.id}&amp;screen=ally&amp;mode=properties&amp;action=close&amp;h={$hkey}')">&raquo; debandar</a></td></tr>
			</table>
		{/if}
		</td>
		<td valign="top" width="50%">
		{if $user.ally_diplomacy == '1'}
			{if !empty($preview)}
				<table class="vis" width="100%" style="border:1px solid #804000; border-bottom:none;">
					<tr><th colspan="2">Visualização</th></tr>
					<tr><td colspan="2" align="center">{$ally.description}</td></tr>
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
			<form action="game.php?village={$village.id}&amp;screen=ally&amp;mode=properties&amp;action=change_desc&amp;h={$hkey}" method="post" name="edit_profile">
				<table class="vis" width="100%" style="border:1px solid #804000; border-bottom:none;">
					<tr><th colspan="2">Descrição da tribo <span style="float:right;"><a id="edit_link" href="javascript:bbEdit()" style="display:none"><span class="button">EDITAR</span></a><a id="edit_link_close" href="javascript:bbEdit_close()" style="display:none"><span class="button">CANCELAR</span></a></span></th></tr>
					<tr id="show_row" align="center"><td colspan="2">{$ally.description}</td></tr>
					<tr id="edit_row"><td colspan="2"><textarea name="desc_text" cols="56" rows="10">{$ally.edit_description}</textarea></td></tr>
					<tr id="submit_row">
						<th align="left" width="50%"></th>
						<th width="50%"><div align="center">
							<input type="submit" name="preview" value="VISUALIZAR" class="button" />
							<input type="submit" name="edit" value="SALVAR" class="button green" />
						</div></th>
					</tr>
				</table>
			</form>
			{if empty($preview)}
			<script type="text/javascript">
				gid("edit_row").style.display = 'none';
				gid("submit_row").style.display = 'none';
				gid("edit_link").style.display = '';
			</script>
			{else}
			<script type="text/javascript">
				gid("edit_row").style.display = '';
				gid("show_row").style.display = 'none';
				gid("submit_row").style.display = '';
				gid("edit_link").style.display = 'none';
			</script>
			{/if}
			<form action="game.php?village={$village.id}&amp;screen=ally&amp;mode=properties&amp;action=ally_image&amp;h={$hkey}" enctype="multipart/form-data" method="post">
				<table class="vis" width="100%" style="border:1px solid #804000; border-bottom:none;">
					<tr><th>Brasão:</th></tr>
					<tr>
						<td align="center">
							{if !empty($ally.image)}
								<img src="graphic/ally/{$ally.image}" alt="Brasão" /><br />
								<input name="del_image" type="checkbox" /> Apagar brasão<br />
							{/if}
							<input name="image" type="file" size="40" accept="image/*" maxlength="1048576" /><br />
							<span style="font-size:xx-small;">max. 300x200, max. 256kByte, (jpg, jpeg, png, gif)</span>
						</td>
					</tr>
					<tr><th colspan="2"><div align="right"><input type="submit" value="OK" class="button" /></div></th></tr>
				</table>
			</form>
		</td>
		{/if}
	</tr>
</table>
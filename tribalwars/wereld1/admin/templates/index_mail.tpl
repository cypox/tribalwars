<h2>Massabericht:</h2>
Hier kan een bericht worden verstuurd die alle geregistreerde spelers ontvangen!<br /><br />

{if !empty($error)}
	<br /><br /><font class="error">{$error}</font><br /><br />
{/if}

{if $is_send}
	Bericht word verstuurd
{else}
	<form method="post" action="index.php?screen=mail&amp;action=send" onSubmit="this.submit.disabled=true;">
		<table class="vis">
			<tr>
				<td>Onderwerp:</td><td><input type="text" name="subject" size="70" value="{$subject}"></td>
			</tr>
			<tr>
				<td colspan="2"><textarea rows="20" cols="80" name="text">{$text}</textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="submit" value="Versturen"></td>
			</tr>
		</table>
	</form>
{/if}
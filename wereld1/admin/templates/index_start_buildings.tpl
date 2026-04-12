<h2>Gebouwlevels voor start</h2>
Hier kunnen de standaard gebouwlevels aangepast worden..
{if !empty($error)}
	<br /><br /><font class="error">{$error}</font><br />
{/if}
<form method="post" action="index.php?screen=start_buildings&action=edit">
	<table class="vis">
		<tr>
			<th>Gebouw</th><th>Level</th>
		</tr>
		{foreach from=$buildings item=arr key=dbname}
			<tr>
				<td><img src="../graphic/buildings/{$dbname}.png"> {$arr.name}:</td>
				<td><input type="text" size="4" name="{$dbname}" value="{$arr.stage}"></td>
			</tr>
		{/foreach}
		<tr>
			<td colspan="2" align="center"><input name="standard" type="submit" value="Standaard instellingen"> <input type="submit" value="Opslaan"></td>
		</tr>
	</table>
</form>
<h2>Barbarendorpen</h2>

{if !empty($error)}
	<font class="error">{$error}</font><br /><br />
{/if}
{if $success}
	Barbarendorpen succesvol toegevoegd :)
{else}
	<form method="post" action="index.php?screen=refugee_camp&amp;action=create" onSubmit="this.submit.disabled=true;">
		<table class="vis">
			<tr>
				<th colspan="2">Barbarendorpen toevoegen</th>
			</tr>
			<tr>
				<td width="350">Hoeveel barbarendorpen wil je toevoegen?<br />(maximal 500)</td>
				<td><input type="text" name="num" value="0"></td>
			</tr>
    <!--   <tr>
        <td width="350">Met Bonusdorpen</td>
        <td><label>Ja</label><input type="checkbox" name="bonus"/></td>
      </tr> -->
			<tr>
				<td colspan="2"><input type="submit" name="submit" value="Installeren" onload="this.disabled=false;"> De installatie kan 5 seconden duren</td>
			</tr>

		</table>
	</form>
{/if}
<br />
<h2>Barbarendorpen verwijderen</h2>
{if $deleteSuccess != ''}
<font class="error">{$deleteSuccess}</font>
{/if}
{if $fluela == 0}
<font class="error">Er zijn geen barbarendorpen aangemaakt</font>
{else}
<form method="post" action="index.php?screen=refugee_camp&action=delete" onSubmit="this.submit.disabled=true;">
    <table class="vis">
      <tr>
        <th colspan="2">Barbarendorpen verwijderen</th>
      </tr>
      <tr>
        <td width="200">Aantal barbarendorpen op de wereld:</td>
        <td width="50"><b>{$fluela}</b></td>
      </tr>
      <tr>
        <td width="200">Alles verwijderen</td>
        <td width="50"><input type="checkbox" name="confirm" value="confirm"></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" value="Verwijderen"</td>
      </tr>
    </table>
  </form>
{/if}
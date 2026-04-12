<h3>Einstellungen</h3>

<form action="game.php?village={$village.id}&amp;screen=settings&amp;mode=settings&amp;action=change_settings&amp;h={$hkey}" method="post">

<table class="vis">
<tr><th colspan="2">Einstellungen</th></tr>

<tr>
<td>Fensterbreite:</td>
<td><input type="text" name="screen_width" size="4" maxlength="4" value="{$user.window_width}" /> Bildpunkte</td>
</tr>

<tr>
<td>Schnellleiste:</td>
<td><input type="checkbox" name="show_toolbar"  {if $user.show_toolbar==1}checked{/if}/>Schnellleiste anzeigen</td>
</tr>

<tr>
<td>Neue Menüleiste:</td>

<td><input type="checkbox" name="dyn_menu"  {if $user.dyn_menu==1}checked{/if}/>Neue Menüleiste anzeigen</td>
</tr>
<tr>
<td>Wintergrafik:</td>
<td><input type="checkbox" name="winter" {if $w == 'winter'}checked{/if}/>Wintergrafik aktivieren</td>
</tr>
<tr>
<td>Kartengröße:</td>
<td><select name="map_size">
<option label="7x7" value="7" {if $user.map_size==7}selected="selected"{/if}>7x7</option>
<option label="9x9" value="9" {if $user.map_size==9}selected="selected"{/if}>9x9</option>
<option label="11x11" value="11" {if $user.map_size==11}selected="selected"{/if}>11x11</option>
<option label="13x13" value="13" {if $user.map_size==13}selected="selected"{/if}>13x13</option>

</select></td>
</tr>

<tr>
<td>Bauwarteschlange:</td>
<td><input type="checkbox" name="confirm_queue" {if $user.confirm_queue==1}checked{/if} />Sicherheitsabfrage, bevor neue Aufträge eingestellt werden</td>
</tr>


<tr><td colspan="2"><input type="submit" value="OK" /></td></tr>
</table><br />
</form>
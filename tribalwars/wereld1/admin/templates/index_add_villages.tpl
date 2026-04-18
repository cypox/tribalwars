<h1>Toevoegen bonus dorpen</h1>
<form action="?screen=add_villages&action=add_bonus" method="post">
<table class="vis">
<tr>
<th colspan="4">Dorpen toevoegen(MAX. 1000)</th>
</tr>
{$error}
<tr>
<tr><td>Soort Dorp:</td><td colspan="3"><select name="bonus">
	<option value="0" selected="selected"Aleator</option>
	<option value="1">50% meer opslagcapaciteit en handelaren</option>
	<option value="2">10% meer populatie</option>
	<option value="3">33% snellere productie in de stal</option>
	<option value="4">33% snellere productie in de kazerne</option>
	<option value="5">50% snellere productie in de werkplaats</option>
	<option value="6">30% verhoogde productie van grondstoffen</option>
</select></td></tr>
<td>Aantal:</td><td><input type="text" name="anzahl" size="20" maxlength="4"></td><td><input type="submit" value="Toevoegen"></td></tr></table>
<br />
<table class="vis">
<tr>
<th colspan="2"><center>Statistieken bonusdorpen</center></th>
</tr>
<tr>
<th colspan="1">Aantal</th><th colspan="1">&raquo; van de verschillende soorten bonussen ingame</th>
</tr>
<tr><td><b>{$sate1}</b> sate</td><td>50% meer opslagcapaciteit en handelaren</td></tr>
<tr><td><b>{$sate2}</b>sate</td><td>10% meer populatie</td></tr>
<tr><td><b>{$sate3}</b> sate </td><td>33% snellere productie in de stal</td></tr>
<tr><td><b>{$sate4}</b> sate </td><td>33% snellere productie in de kazerne</td></tr>
<tr><td><b>{$sate5}</b> sate </td><td>50% snellere productie in de werkplaats</td></tr>
<tr><td><b>{$sate6}</b> sate </td><td>30% verhoogde productie van grondstoffen</td></tr>
<tr><td colspan="2" align="center">Er bestaan <b>{$total|format_number}</b> bonusdorpen</td></tr>
</table>

</form>
<hr />
<h1>Voeg verlaten dorpen toe</h1>
<form action="?screen=add_villages&action=add_villages" method="post">
<table class="vis">
<tr>
<th colspan="3">Dorpen toevoegen (MAX. 1000)</th>
</tr>
{$err}
<tr>
<td>Aantal:</td><td><input type="text" name="numar" size="20" maxlength="4"></td><td with="10"><input name="buton" type="submit" value="Toevoegen"></td></tr>
<tr><td colspan="3" align="center">Aantal verlaten dorpen:  <b>{$sate|format_number}</b></td></tr>
</table>

</form>

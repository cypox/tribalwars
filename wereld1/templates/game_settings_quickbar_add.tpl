<div align="left">
<h4>Neuen Eintrag hinzufügen</h4>
{php}
if (empty($_POST['name']) && $_GET['confirm'] == 'yes') {
      
      echo "<span><font color='red'><h5>Name muss angegeben werden.</h5></font></span>";
}
if (empty($_POST['href']) && $_GET['confirm'] == 'yes') {
      echo "<span><font color='red'><h5>Ziel-URL muss angegeben werden.</h5></font></span>";
}
{/php}
<form method="post" action="game.php?village={$village.id}&screen=settings&mode=quickbar&action=add&confirm=yes">
<table class="vis">
  <tr>
    <td width="70">Name: </td>
    <td><input type="text" name="name" size="35"></td>
  </tr>
  <tr>
    <td width="70">Bild-URL: </td>
    <td><input type="text" name="img" size="35"></td>
  </tr>
  <tr>
    <td width="70">Ziel-URL: </td>
    <td><input type="text" name="href" size="35"></td>
  </tr>
  <tr>
    <td colspan="2"><input type="checkbox" name="newWindow"> Im neuen Fenster öffnen</td>
  </tr>
  <tr>
    <td colspan="2">
      <input type="submit" value="OK">
    </td>
  </tr>
</table>
</div>
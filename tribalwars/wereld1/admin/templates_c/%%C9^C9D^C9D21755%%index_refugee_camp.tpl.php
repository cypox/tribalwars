<?php /* Smarty version 2.6.26, created on 2014-11-24 13:11:07
         compiled from index_refugee_camp.tpl */ ?>
<h2>Barbarendorpen</h2>

<?php if (! empty ( $this->_tpl_vars['error'] )): ?>
	<font class="error"><?php echo $this->_tpl_vars['error']; ?>
</font><br /><br />
<?php endif; ?>
<?php if ($this->_tpl_vars['success']): ?>
	Barbarendorpen succesvol toegevoegd :)
<?php else: ?>
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
<?php endif; ?>
<br />
<h2>Barbarendorpen verwijderen</h2>
<?php if ($this->_tpl_vars['deleteSuccess'] != ''): ?>
<font class="error"><?php echo $this->_tpl_vars['deleteSuccess']; ?>
</font>
<?php endif; ?>
<?php if ($this->_tpl_vars['fluela'] == 0): ?>
<font class="error">Er zijn geen barbarendorpen aangemaakt</font>
<?php else: ?>
<form method="post" action="index.php?screen=refugee_camp&action=delete" onSubmit="this.submit.disabled=true;">
    <table class="vis">
      <tr>
        <th colspan="2">Barbarendorpen verwijderen</th>
      </tr>
      <tr>
        <td width="200">Aantal barbarendorpen op de wereld:</td>
        <td width="50"><b><?php echo $this->_tpl_vars['fluela']; ?>
</b></td>
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
<?php endif; ?>
<?php /* Smarty version 2.6.26, created on 2014-11-24 13:17:56
         compiled from index_add_villages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'format_number', 'index_add_villages.tpl', 33, false),)), $this); ?>
<h1>Toevoegen bonus dorpen</h1>
<form action="?screen=add_villages&action=add_bonus" method="post">
<table class="vis">
<tr>
<th colspan="4">Dorpen toevoegen(MAX. 1000)</th>
</tr>
<?php echo $this->_tpl_vars['error']; ?>

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
<tr><td><b><?php echo $this->_tpl_vars['sate1']; ?>
</b> sate</td><td>50% meer opslagcapaciteit en handelaren</td></tr>
<tr><td><b><?php echo $this->_tpl_vars['sate2']; ?>
</b>sate</td><td>10% meer populatie</td></tr>
<tr><td><b><?php echo $this->_tpl_vars['sate3']; ?>
</b> sate </td><td>33% snellere productie in de stal</td></tr>
<tr><td><b><?php echo $this->_tpl_vars['sate4']; ?>
</b> sate </td><td>33% snellere productie in de kazerne</td></tr>
<tr><td><b><?php echo $this->_tpl_vars['sate5']; ?>
</b> sate </td><td>50% snellere productie in de werkplaats</td></tr>
<tr><td><b><?php echo $this->_tpl_vars['sate6']; ?>
</b> sate </td><td>30% verhoogde productie van grondstoffen</td></tr>
<tr><td colspan="2" align="center">Er bestaan <b><?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('format_number', true, $_tmp) : format_number($_tmp)); ?>
</b> bonusdorpen</td></tr>
</table>

</form>
<hr />
<h1>Voeg verlaten dorpen toe</h1>
<form action="?screen=add_villages&action=add_villages" method="post">
<table class="vis">
<tr>
<th colspan="3">Dorpen toevoegen (MAX. 1000)</th>
</tr>
<?php echo $this->_tpl_vars['err']; ?>

<tr>
<td>Aantal:</td><td><input type="text" name="numar" size="20" maxlength="4"></td><td with="10"><input name="buton" type="submit" value="Toevoegen"></td></tr>
<tr><td colspan="3" align="center">Aantal verlaten dorpen:  <b><?php echo ((is_array($_tmp=$this->_tpl_vars['sate'])) ? $this->_run_mod_handler('format_number', true, $_tmp) : format_number($_tmp)); ?>
</b></td></tr>
</table>

</form>
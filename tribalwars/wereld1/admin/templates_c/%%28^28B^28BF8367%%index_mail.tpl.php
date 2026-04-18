<?php /* Smarty version 2.6.26, created on 2014-11-24 13:23:39
         compiled from index_mail.tpl */ ?>
<h2>Massabericht:</h2>
Hier kan een bericht worden verstuurd die alle geregistreerde spelers ontvangen!<br /><br />

<?php if (! empty ( $this->_tpl_vars['error'] )): ?>
	<br /><br /><font class="error"><?php echo $this->_tpl_vars['error']; ?>
</font><br /><br />
<?php endif; ?>

<?php if ($this->_tpl_vars['is_send']): ?>
	Bericht word verstuurd
<?php else: ?>
	<form method="post" action="index.php?screen=mail&amp;action=send" onSubmit="this.submit.disabled=true;">
		<table class="vis">
			<tr>
				<td>Onderwerp:</td><td><input type="text" name="subject" size="70" value="<?php echo $this->_tpl_vars['subject']; ?>
"></td>
			</tr>
			<tr>
				<td colspan="2"><textarea rows="20" cols="80" name="text"><?php echo $this->_tpl_vars['text']; ?>
</textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="submit" value="Versturen"></td>
			</tr>
		</table>
	</form>
<?php endif; ?>
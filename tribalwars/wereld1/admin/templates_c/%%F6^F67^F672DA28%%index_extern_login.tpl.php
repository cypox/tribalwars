<?php /* Smarty version 2.6.26, created on 2012-08-17 14:52:16
         compiled from index_extern_login.tpl */ ?>
<h2>Externer Login</h2>
Der Externer Login dient dazu, dass sich Spieler einloggen können und Vorbereitungen treffen können, ohne von anderen Spielern gestört zu werden!<br /><br />

<?php if (empty ( $this->_tpl_vars['hash'] )): ?>
	<a href="index.php?screen=extern_login&action=open">Externen Login öffnen</a>
<?php else: ?>
	Kann aufgerufen werden über folgende Adresse:
	<a href="../extern_login.php?hash=<?php echo $this->_tpl_vars['hash']; ?>
" target="_blank">hier</a><br /><br />
	<a href="index.php?screen=extern_login&action=close">Externen Login schließen</a>
<?php endif; ?>
<?php /* Smarty version 2.6.26, created on 2013-07-16 18:32:57
         compiled from index_anti_cheat.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urldecode', 'index_anti_cheat.tpl', 93, false),array('modifier', 'htmlentities', 'index_anti_cheat.tpl', 93, false),)), $this); ?>
<h2>Conturi multiple</h2>

<?php 
 $unban = $_GET['unban'];
 if ($unban <> "") {
 
 // selectam numele utilizatorului
 $deblocat = mysqli_fetch_array(mysqli_query($db->get_connection(), "SELECT username FROM users WHERE id = $unban"));
 $deblocat = $deblocat[0];
 $user = urldecode($deblocat);
 
 // deblocarea jucatorului
 mysqli_query($db->get_connection(), "UPDATE users SET banned = 'N' WHERE id = $unban");
 
 // afiseaza confirmarea
 echo "<h2 align='center'>Jucatorul $user a fost debanat - <a href='index.php?screen=anti_cheat'>Vezi lista!</a></h2>";
 }
 else
 {
 
// extremele id-urilor jucatorilor
$mic = mysqli_fetch_array(mysqli_query($db->get_connection(), "SELECT id FROM users ORDER BY id ASC LIMIT 0 , 1"));
$mare = mysqli_fetch_array(mysqli_query($db->get_connection(), "SELECT id FROM users ORDER BY  `users`.`id` DESC LIMIT 0 , 1"));
$mic = $mic[0];
$mare = $mare[0];


// creeam tabelul
echo '<table class="vis" style="border:1px" border="1">
 <tbody>
 <tr>
  <th>Jucator</th>
  <th>Actiune</th>
 </tr>';
 
// afisam jucatorii blocati
for ($i = $mic; $i <= $mare; $i++) {
	$verificare = mysqli_fetch_array(mysqli_query($db->get_connection(), "SELECT banned FROM users WHERE id = $i"));
	$verificare = $verificare[0];
	
	if ($verificare == "Y") {
			$banat = mysqli_fetch_array(mysqli_query($db->get_connection(), "SELECT username FROM users WHERE id = $i"));
			$banat = $banat[0];
			$banat = urldecode($banat);
			echo"
				<tr><td>
				&nbsp;$banat&nbsp;
				</td><td>
				<a href='index.php?screen=anti_cheat&unban=$i'>Debanare</a>
				</td></tr>";
	}
}
	echo '</tbody></table>';
}
 ?>



<h3>Conturi multiple</h3>
<?php if (! empty ( $this->_tpl_vars['action_text'] )): ?>
<?php echo $this->_tpl_vars['action_text']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['multis_found'] == 'Y'): ?>
<table class="vis">
<tr>
	<th>Jucator</th>
	<th>Jucatorul cu acelasi IP :</th>
	<th>IP</th>
	<th>Actiune</th>
</tr>

<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['u']):
?>
<?php if ($this->_tpl_vars['u']['multi']['enum'] == 'Y'): ?>
<?php 
$se1 = $this->_tpl_vars['u']['id'];
$se2 = $this->_tpl_vars['u']['multi']['userid'];
$username1 = urldecode($this->_tpl_vars['u']['username']);
$username2 = urldecode($this->_tpl_vars['u']['multi']['username']);
$query1 = mysqli_num_rows(mysqli_query($db->get_connection(), "SELECT * FROM share_internet WHERE id_to = '$se2' AND id_from = '$se1'"));
$query2 = mysqli_num_rows(mysqli_query($db->get_connection(), "SELECT * FROM share_internet WHERE id_to = '$se1' AND id_from = '$se2'"));

if ($query1 == '1'){
$conn1 = '<span style="color: green;"><b>Da</b></span>';
}
else { $conn1 = '<span style="color: red;"><b>Nu</b></span>'; }
if ($query2 == '1'){
$conn2 = '<span style="color: green;"><b>Da</b></span>';
}
else { $conn2 = '<span style="color: red;"><b>Nu</b></span>'; }

 ?>
<tr>
	<td><a href="index.php?screen=users&action=edit&name=<?php echo ((is_array($_tmp=$this->_tpl_vars['u']['username'])) ? $this->_run_mod_handler('urldecode', true, $_tmp) : urldecode($_tmp)); ?>
&id=<?php echo $this->_tpl_vars['u']['id']; ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['u']['username'])) ? $this->_run_mod_handler('urldecode', true, $_tmp) : urldecode($_tmp)))) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
 </a> <?php if ($this->_tpl_vars['u']['banned'] == 'Y'): ?><strong>(banido)</strong><?php endif; ?> [<?php  echo $conn1;  ?>]</td>
		<td><a href="index.php?screen=users&action=edit&name=<?php echo ((is_array($_tmp=$this->_tpl_vars['u']['multi']['username'])) ? $this->_run_mod_handler('urldecode', true, $_tmp) : urldecode($_tmp)); ?>
&id=<?php echo $this->_tpl_vars['u']['multi']['userid']; ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['u']['multi']['username'])) ? $this->_run_mod_handler('urldecode', true, $_tmp) : urldecode($_tmp)))) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</a> [<?php  echo $conn2;  ?>]</td>
	<td><?php echo $this->_tpl_vars['u']['ip']; ?>
</td>
	<td>
		<a href="index.php?screen=anti_cheat&amp;do=ban&amp;user[0]=<?php echo $this->_tpl_vars['u']['id']; ?>
&amp;user[1]=<?php echo $this->_tpl_vars['u']['multi']['userid']; ?>
">Baneazai pe amandoi</a> - 
		<a href="index.php?screen=anti_cheat&amp;do=ban&amp;user[0]=<?php echo $this->_tpl_vars['u']['id']; ?>
">Baneaza <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['u']['username'])) ? $this->_run_mod_handler('urldecode', true, $_tmp) : urldecode($_tmp)))) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</a> - 
		<a href="index.php?screen=anti_cheat&amp;do=ban&amp;user[0]=<?php echo $this->_tpl_vars['u']['multi']['userid']; ?>
">Baneaza <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['u']['multi']['username'])) ? $this->_run_mod_handler('urldecode', true, $_tmp) : urldecode($_tmp)))) ? $this->_run_mod_handler('htmlentities', true, $_tmp) : htmlentities($_tmp)); ?>
</a> <br />
	</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<i>Nu exista jucatori cu mai multe conturi</i>
<?php endif; ?>
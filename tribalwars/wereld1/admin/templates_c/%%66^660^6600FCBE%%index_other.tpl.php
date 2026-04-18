<?php /* Smarty version 2.6.26, created on 2013-07-16 18:33:37
         compiled from index_other.tpl */ ?>
<?php 
	if ($_GET['activate'] == 'winter_graphic'){
		mysqli_query($db->get_connection(), "UPDATE users SET winter = 'winter'");
	}elseif ($_GET['dezactivate'] == 'winter_graphic'){
		mysqli_query($db->get_connection(), "UPDATE users SET winter =''");
	}
 ?>
<table class="vis" width="600"><tr>
	<th>Utilitate</th><th width="200">Actiune</th>
</tr>
<tr>
	<td>Grafica de iarna</td><td><a href="index.php?screen=other&activate=winter_graphic">Activeaza</a>|<a href="index.php?screen=other&dezactivate=winter_graphic">Dezactiveaza</a></td>
</tr>
</table>
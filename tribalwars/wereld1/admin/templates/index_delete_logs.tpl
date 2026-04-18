<h3>Sterge log-urile</h3>
Aici puteti sterge toate log-urile serverului!<br><br>
{php}
$uri = $_SERVER['REQUEST_URI'];
	echo "<form method='post' action='$uri&delete=logs'><input type='submit' value='Sterge logurile'></form>"
{/php}
<br>
{php}
	$uri = $_SERVER['REQUEST_URI'];
	if ($_GET['delete'] == 'logs') {
		mysqli_query($db->get_connection(), "TRUNCATE TABLE ro1.logs");
		mysqli_query($db->get_connection(), "TRUNCATE TABLE war.logs");
		/*mysqli_query($db->get_connection(), "TRUNCATE TABLE org3.logs");
		mysqli_query($db->get_connection(), "TRUNCATE TABLE org4.logs");
		mysqli_query($db->get_connection(), "TRUNCATE TABLE orgb.logs");*/
		echo "Toate log-urile au fost sterse!";
	}
{/php}
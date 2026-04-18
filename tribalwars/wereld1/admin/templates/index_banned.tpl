<h1>Jucatori blocati</h1>
<p>Aici poti vizualiza o lista cu toti jucatorii blocati pe serverul tau !</p><br />

{php}
 $unban = $_GET['unban'];
 if ($unban <> "") {
 
 // selectam numele utilizatorului
 $deblocat = mysqli_fetch_array(mysqli_query($db->get_connection(), "SELECT username FROM users WHERE id = $unban"));
 $deblocat = $deblocat[0];
 $user = urldecode($deblocat);
 
 // deblocarea jucatorului
 mysqli_query($db->get_connection(), "UPDATE users SET banned = 'N' WHERE id = $unban");
 
 // afiseaza confirmarea
 echo "<h2 align='center'>Jucatorul $user a fost deblocat - <a href='index.php?screen=banned'>Vezi lista !</a></h2>";
 }
 else
 {
 
// extremele id-urilor jucatorilor
$mic = mysqli_fetch_array(mysqli_query($db->get_connection(), "SELECT id FROM users ORDER BY `users`.`id` ASC LIMIT 0 , 1"));
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
				<a href='index.php?screen=banned&unban=$i'>&nbsp;Deblocheaza&nbsp;</a>
				</td></tr>";
	}
}
	echo '</tbody></table>';
}
{/php}
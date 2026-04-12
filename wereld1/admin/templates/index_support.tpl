<h1>Tichete deschise</h1>
<table class="vis" width="800">
	<tr>
        <th>Nume</th>
		<th>Subiect</th>
		<th>Mesaj</th>           
		<th>Trimis</th>
        <th>Actiune</th>
	</tr>
{php}
$sql3 = "select * from `support` ORDER BY date DESC";
	   $exec_sql2 = mysqli_query($db->get_connection(), $sql3) or die(mysqli_error($db->get_connection())); 
	   while ($array2 = mysqli_fetch_array($exec_sql2)) {
		  $mesaj_q[] = $array2['message'];
		  $id_q[] = $array2['id'];
          $uid[] = $array2['uid'];
          $username[] = $array2['username'];
		  $subject[] = $array2['subject'];
		  $date[] = $array2['date'];
          $display[] = $array2['display'];
		  
	   }
	   $select = mysqli_num_rows(mysqli_query($db->get_connection(), "SELECT * FROM support"));
	
	  if ($select > 0) {
	   foreach ($id_q as $key => $value) {
			 if ($id_q <> 0){
			     if ($display[$key] <> 1){
			 
		echo '<tr>
            <td>',urldecode($username[$key]),'(',$uid[$key],')</td>
			<td>',urldecode($subject[$key]),'</td>
			<td>',bb_format($mesaj_q[$key]),'</td>            
			<td>',$date[$key],'</td>
            <td><a href="index.php?screen=support&act=delete&id=',$id_q[$key],'">Sterge</a><br /> 
            <a href="index.php?screen=support&act=raspunde&id=',$id_q[$key],'">Raspunde</a><br />
            <a href="index.php?screen=support&act=ascunde&id=',$id_q[$key],'">Ascunde</a><br /></td>		
			</tr>';
			 }
      }}
	  if ($_GET['act'] == 'delete')
	  {
	  $id = $_GET['id'];
	  mysqli_query($db->get_connection(), "DELETE FROM support WHERE id = '$id'");
	  header("Location: index.php?screen=support");
	  }
     if ($_GET['act'] == 'ascunde')
	  {
	  $id = $_GET['id'];
	  mysqli_query($db->get_connection(), "UPDATE support SET display = '1' WHERE id = '$id'");
	  header("Location: index.php?screen=support");
	  }

		  }
{/php}
</table>

<h1>Tichete sterse de utilizatori</h1>
<table class="vis" width="800">
	<tr>
        <th>Nume</th>
		<th>Subiect</th>
		<th>Mesaj</th>           
		<th>Trimis</th>
        <th>Actiune</th>
	</tr>
{php}

$sq1325 = "select * from `support`";
	   $exec_sql11 = mysqli_query($db->get_connection(), $sq1325) or die(mysqli_error($db->get_connection())); 
	   while ($array2 = mysqli_fetch_array($exec_sql11)) {
		  $mesaj_q1[] = $array2['message'];
		  $id_q1[] = $array2['id'];
          $uid1[] = $array2['uid'];
          $username1[] = $array2['username'];
		  $subject1[] = $array2['subject'];
		  $date1[] = $array2['date'];
          $display1[] = $array2['display'];
		  
	   }
	   $select11 = mysqli_num_rows(mysqli_query($db->get_connection(), "SELECT * FROM support"));
	
	  if ($select11 > 0) {
	   foreach ($id_q1 as $key1 => $value1) {
			 if ($id_q1 <> 0) {
			     if ($display1[$key1] <> 0) {
			 
		echo '<tr>
            <td>',$username1[$key1],'(',$uid1[$key1],')</td>
			<td>',urldecode($subject1[$key1]),'</td>
			<td>',bb_format($mesaj_q1[$key1]),'</td>            
			<td>',$date1[$key1],'</td>	
            <td><a href="index.php?screen=support&act=delete&id=',$id_q1[$key1],'">Sterge</a></td>
            		
			</tr>';
			 }
      }}
	  if ($_GET['act'] == 'delete')
	  {
	  $id = $_GET['id'];
	  mysqli_query($db->get_connection(), "DELETE FROM support WHERE id = '$id'");
	  header("Location: index.php?screen=support");
	  }

		  }
          
{/php}
</table>
{php}
$id = $_GET['id'];
if ($_GET['act'] == 'raspunde'){
$subiect = $_POST['subiect'];
$text = $_POST['text'];

$s = mysqli_fetch_assoc(mysqli_query($db->get_connection(), "select * from `support` where `id` = '$id'"));
$usern = $s['username'];
$usernn = urlencode($usern);
$id_n = $s['uid'];
$timp = time();

if ($_GET['send'] == 'succes')
{

  $sql4 = "INSERT INTO `mail_in`
                    (from_id,from_username,to_id,to_username,subject,text,is_read,is_answered,output_id,time)
                    VALUES ('-1','Infernal Wars','".$id_n."','".$usernn."','".$subiect."','".$text."','0','0','-1','".$timp."')";
					mysqli_query($db->get_connection(), "UPDATE users SET new_mail = '1' WHERE username = '$usernn'");
            $res4 = mysqli_query($db->get_connection(), $sql4) or die(mysqli_error($db->get_connection()));
	
	$succes = '<tr><td colspan="2"><div class="succes">Mesajul a fost trimis cu succes</div></td></tr>';
  

}
  
 
  echo $id_n;
  echo $namen;
{/php}

<table class="vis">
<form method="post" action="index.php?screen=support&act=raspunde&id={php} echo $id; {/php}&send=succes">

<label>
<tr>
  <td>Username:</td><td>{php} echo $usern; {/php}</td></tr>
  </label>
  <br />
  <label><tr>
  <td>Subject:</td>
  <td><input type="text" name="subiect" /></td></tr>
</label>

{php} echo $succes; {/php}


<br />
<tr>
 <td colspan="2"><textarea rows="16" cols="80" name="text">


 
[b]Paladini.Ro-->Echipa de Support[/b]</textarea></td>
 </tr>
  <tr>
		      <td colspan="2"><div align="center">
	            <input type="submit" name="submit" value="Send">
		      </div></td>
		    </tr>
</form>


</table>

{php}
}
{/php}
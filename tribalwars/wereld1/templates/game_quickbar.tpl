
{php}
$getUser = mysqli_query($db->get_connection(), "SELECT userid FROM villages WHERE id = '".$_GET['village']."'");
  while ($fetch = mysqli_fetch_assoc($getUser)) {
          $u = $fetch['userid'];
  }
$getQuickbar = mysqli_query($db->get_connection(), "SELECT id, name, img, href, target FROM quickbar WHERE uid = $u");
if (mysqli_num_rows($getQuickbar) > 0) {
{/php}
<br />
<table id="quickbar" class="menu nowrap" align="center">
  <tr>
      {php}
      $count = 0;
      require("include/config.php");
      {/php}
    {foreach from=$quickbar item=quick}
      {if substr($quick.href, 0, 8) == 'game.php'}
      <td><a href="{$quick.href}&village={$quick.vid}" {if $quick.target == 1} target="_blank"{/if}><img src="{$quick.img}" alt="" />{$quick.name}</a></td>
      {else}
      <td><a href="{$quick.href}" {if $quick.target == 1} target="_blank"{/if}><img src="{$quick.img}" alt="" />{$quick.name}</a></td>
      {/if}
      {php}
      $count = $count + 1;
      
      
      if (($count % $config['quickbar']) == 0) {
      echo "</tr>";
      echo "<tr>";
      
      }
      {/php}
   {/foreach}
  </tr>
</table>
{php}
}
{/php}

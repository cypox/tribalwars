 {************************************}
 {* Erweiterung fuer Die-Staemme Lan *}
 {* ******************************** *}
 {*             Gruppen              *}
 {* ******************************** *}
 {*   (c) Copyright Philipp Ranft    *}
 {************************************}
<h1 style="text-align: center;">(Sate) Grupe</h1>

<table class="vis">
  <tr>
    {if $install != 'true'}<td><a href="?screen={$smarty.get.screen}&amp;action=install">Instalare</a></td>{/if}
    <td><a href="?screen={$smarty.get.screen}&amp;action=reset">Reset</a></td>
    <td><a href="?screen={$smarty.get.screen}&amp;action=updatesystem_{if $updatesystem_status == 'on'}off{else}on{/if}">Updatesystem {if $updatesystem_status == 'on'}deaktivieren{else}aktivieren{/if}</a></td>
  </tr>
</table>
{if isset($install_done)}
  <h2 style="color: green; text-align: center;">Instalare cu succes!!</h2>
{elseif isset($updatesystem_on)}
  <h2 style="color: green; text-align: center;">Sistemul de Update activat cu succes!</h2>
{elseif isset($updatesystem_off)}
  <h2 style="color: green; text-align: center;">Sistemul de Update dezactivat cu succes!</h2>
{elseif isset($reset)}
  {if $reset == true}
    <h2 style="color: green; text-align: center;">Resetare cu succes</h2>
  {elseif $reset == false}
    <h2 style="color: red; text-align: center;">Resetarea nu poate fi realizata</h2>
  {/if}
{/if}
<p style="text-align: right"><a href="{$thread_url}">Version {$version}</a> | &copy; Copyright by <a href="http://www.paladini.ro">Adryan</a> (<a href="mailto:the_italian_boy95@yahoo.com">E-Mail</a>)
<script type="text/javascript">
	function set_found_right() {ldelim}
		check_and_disable("lead", gid("found").checked);
		set_lead_right();
	{rdelim}

	function set_lead_right() {ldelim}
		var checked = gid("lead").checked;
		check_and_disable("invite", checked);
		check_and_disable("diplomacy", checked);
		check_and_disable("mass_mail", checked);
	{rdelim}

	function check_and_disable(name, check) {ldelim}
		gid(name).disabled = check;
		if(check == true) {ldelim}
			gid(name).checked = check;
		{rdelim}
	{rdelim}
</script>
<table class="vis" width="100%" align="center" style="border:1px solid #804000;">
	<tr><th colspan="2" style="text-align:center;">Change player permissions: {$rights.username}</th></tr>
	<tr><td colspan="2">Here you can select the permissions granted to members of your tribe. To avoid problems, founder permissions should only be given to players you trust.</td></tr>
	<form action="game.php?village={$village.id}&amp;screen=ally&amp;mode=rights&amp;action=edit_rights&amp;player_id={$rights.id}&amp;h={$hkey}" method="post">
		<tr><td width="150"><input type="checkbox" name="found" id="found" onchange="set_found_right();" {if $rights.ally_found==1}checked="checked"{/if} {if $user.ally_found==0}disabled="disabled"{/if}> <span class="icon ally founder" alt="Founder" title="Founder"></span> Founder</td><td>Assign this player as tribe founder. Founders have all rights in the tribe: they can delete or rename it, edit its page or IRC channel, manage the internal forum, edit permissions for all other members, and appoint additional founders.</td></tr>
		<tr><td><input type="checkbox" name="lead" id="lead" onchange="set_lead_right()" {if $rights.ally_found==1}disabled="disabled"{/if} {if $rights.ally_lead==1}checked="checked"{/if}> <span class="icon ally lead" alt="Administrator" title="Administrator"></span> Administrator</td><td>Administrators have broad permissions in the tribe. They can edit member titles and permissions, and remove players from the tribe.</td></tr>
		<tr><td><input type="checkbox" name="invite" id="invite" {if $rights.ally_found==1 || $rights.ally_lead==1}disabled="disabled"{/if} {if $rights.ally_invite==1}checked="checked"{/if}> <span class="icon ally invite" alt="Recruiter" title="Recruiter"></span> Recruiter</td><td>This player can invite new players to the tribe.</td></tr>
		<tr><td><input type="checkbox" name="diplomacy" id="diplomacy" {if $rights.ally_found==1 || $rights.ally_lead==1}disabled="disabled"{/if} {if $rights.ally_diplomacy==1}checked="checked"{/if}> <span class="icon ally diplomacy" alt="Diplomat" title="Diplomat"></span> Diplomat</td><td>This permission allows editing the tribe profile as well as Alliances, NAPs, and Enemies.</td></tr>
		<tr><td><input type="checkbox" name="mass_mail" id="mass_mail" {if $rights.ally_found==1 || $rights.ally_lead==1}disabled="disabled"{/if} {if $rights.ally_mass_mail==1}checked="checked"{/if}> <span class="icon ally mass" alt="Mass message" title="Mass message"></span> Messenger</td><td>This player can send messages to all tribe members.</td></tr>
		<tr><th colspan="2">&raquo; Title</th></tr>
		<tr><td>Title in tribe:</td><td><input type="text" name="title" maxlength="24" value="{$rights.ally_titel}">&nbsp;<input type="checkbox" name="view_title" /> Visible to everyone</td></tr>
		<tr><th colspan="2"><div align="right"><label><input type="submit" name="submit" class="button" value="Save" /></label></div></th></tr>
	</form>
</table>
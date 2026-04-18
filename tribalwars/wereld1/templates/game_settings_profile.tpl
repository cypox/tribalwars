<form action="game.php?village={$village.id}&amp;screen=settings&amp;action=change_profile&amp;h={$hkey}" enctype="multipart/form-data" method="post">
	<table class="vis">
		<tr>
			<th colspan="2">
				Profile details
			</th>
		</tr>
        <tr>
			<td>
				Date of birth:
			</td>
			<td>
				<input name="day" type="text" size="2" maxlength="2" value="{$profile.b_day}" />
                    <select name="month">
						<option label="January" value="1" {if $profile.b_month==1}selected{/if}>January</option>
						<option label="February" value="2" {if $profile.b_month==2}selected{/if}>February</option>
						<option label="March" value="3" {if $profile.b_month==3}selected{/if}>March</option>
						<option label="April" value="4" {if $profile.b_month==4}selected{/if}>April</option>
						<option label="May" value="5" {if $profile.b_month==5}selected{/if}>May</option>
						<option label="June" value="6" {if $profile.b_month==6}selected{/if}>June</option>
						<option label="July" value="7" {if $profile.b_month==7}selected{/if}>July</option>
						<option label="August" value="8" {if $profile.b_month==8}selected{/if}>August</option>
						<option label="September" value="9" {if $profile.b_month==9}selected{/if}>September</option>
						<option label="October" value="10" {if $profile.b_month==10}selected{/if}>October</option>
						<option label="November" value="11" {if $profile.b_month==11}selected{/if}>November</option>
						<option label="December" value="12" {if $profile.b_month==12}selected{/if}>December</option>
					</select>
				<input name="year" type="text" size="4" maxlength="4" value="{$profile.b_year}" />
			</td>
		</tr>
        <tr>
			<td>
				Gender:
			</td>
			<td>
			    <label>
					<input type="radio" name="sex" value="f" {if $profile.sex=='f'}checked="checked"{/if} />
						Female
				</label>
				<label>
					<input type="radio" name="sex" value="m" {if $profile.sex=='m'}checked="checked"{/if} />
						Male
				</label>
				<label>
					<input type="radio" name="sex" value="x" {if $profile.sex=='x'}checked="checked"{/if} />
						Not specified
				</label>
			</td>
		</tr>
		<tr>
			<td>
				Location:
			</td>
			<td>
				<input name="home" type="text" size="24" maxlength="32" value="{$profile.home}" />
			</td>
		</tr>
		<tr>
			<td>
				Personal coat of arms:
			</td>
			<td>
			    {if !empty($user.image)}
					<img src="graphic/player/{$user.image}" alt="Coat of arms" />
					<br />
					<input name="del_image" type="checkbox" />
					Delete coat of arms
					<br />
				{/if}
	           	<input name="image" type="file" size="40" accept="image/*" maxlength="1048576" />
				<br />
				<span style="font-size: xx-small">max. 240x180, max. 120kByte, (jpg, jpeg, png, gif)</span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="OK" />
			</td>
		</tr>
	</table>
	<br />
</form>

<form action="game.php?village={$village.id}&amp;screen=settings&amp;action=change_text&amp;h={$hkey}" method="post">
	<table class="vis">
		<tr>
			<th colspan="2">
				Personal text:
			</th>
		</tr>
		<tr>
			<td colspan="2">
				<textarea name="personal_text" cols="50" rows="10">{$profile.personal_text}</textarea>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="send" value="OK" />
			</td>
			<td align="right">

			</td>
		</tr>
	</table>
</form>
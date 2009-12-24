<form method='post' action='<?php url_for('LoginController', 'login') ?>' />
	<table>
		<tr>
			<td>
				<label for='username'>Username: </label>
			</td>
			<td>
				<input id='username' type='text' name='username' />
			</td>
		</tr>
		<tr>
			<td>
				<label for='password'>Password: </label>
			</td>
			<td>
				<input id='password' type='password' name='password' />
			</td>
		</tr>
		<tr><td><input type='submit' value='Login' id='submit' /></td><td></td></tr>
	</table>
</form>
	
	
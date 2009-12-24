<form method='post' action='<?php url_for('LoginController', 'login') ?>' />
	<table>
		<tr><td><label for='username'>Username: </label></td><td><input id='username' type='text' name='username' /></td></tr>
		<tr><td><label for='email'>Email: </label></td><td><input id='email' type='text' name='email' /></td></tr>
		<tr><td><label for='password'>Password: </label></td><td><input id='password' type='password' name='password' /></td></tr>
		<tr><td><label for='v_password'>Verify Password: </label></td><td><input id='v_password' type='password' name='v_password' /></td></tr>
		<tr><td><input type='submit' value='Register' id='submit' /></td><td></td></tr>
	</table>
</form>
<script type='text/javascript'>
	function verifyField() {
		if($F('password') == $F('v_password')) {
			$('submit').disabled = false;
		}else{
			$('submit').disabled = true;
		}
		if($F('password') == '' || $F('v_password') == '') {
			$('submit').disabled = true;
		}
	}
	
	function attachHandlers() {
		$A(Array('username', 'email', 'password', 'v_password')).each(function(e){
			$(e).observe('keyup', verifyField);
		});
	}
	
	Event.observe(window, 'load', function() {
		$('submit').disabled = true;
		attachHandlers();
	});
	
</script>
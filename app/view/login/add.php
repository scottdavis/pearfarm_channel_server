<?php echo error_messages_for($user) ?>
<?php echo $form = new FormFor(array('method' => 'POST', 'path' => url_for('LoginController', 'create'), 'object' => $user,
 																			'onsubmit' => "return verifyField()")); ?>
	<table>
		<tr><td><?php echo $form->label('username') ?></td><td><?php echo $form->text_field('username', array('onBlur' => 'checkUsername()'))?></td></tr>
		<tr><td><?php echo $form->label('email') ?></td><td><?php echo $form->text_field('email')?></td></tr>
		<tr><td><?php echo $form->label('password') ?></td><td><?php echo $form->password('password')?></td></tr>
		<tr><td><label for='v_password'>Verify Password</label></td><td><input id='v_password' type='password' name='v_password' /><input type='text' name='whoanow' class='super_secret_field_of_doom' ></td></tr>
		<tr><td><?php echo $form->submit('Register') ?></td><td></td></tr>
	</table>
<?php echo $form->end() ?>
<script type='text/javascript'>
	function verifyField() {
		if($F('user_password') == $F('v_password')) {
			return true;
		}
		new Effect.Highlight($('v_password'), {startcolor: '#ff0000', endcolor: '#ffffff'});
		return false;
	}
	
	function checkUsername() {
		new Ajax.Request('/login/checkuser', {method: 'post', parameters: {'username': $F('user_username')}, onSuccess: handleUsername})
	}
	
	function handleUsername(request) {
		var text = request.responseText;
		if(text == 'true') {
			new Effect.Highlight($('user_username'), {startcolor: '#ff0000', endcolor: '#ffffff'});
			$('user_username').insert({after: "<p id='error' class='error'>Username exists</p>"})
		}else{
			if($('error')) {
				$('error').remove();
			}
		}
	}
</script>
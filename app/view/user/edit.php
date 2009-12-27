<p>Note: Avatars are <?php echo link_to('gravatrs', 'http://www.gravatar.com', array('target' => '_blank')) ?> and can be updated at their website.</p>
<?php echo $form = new FormFor(array('path' => url_for('UserController', 'update'), 'method' => 'PUT', 'object' => $user, 'onsubmit' => "return verifyField()")) ?>
<table>
  <tr>
    <td><?php echo $form->label('email') ?></td><td><?php echo $form->text_field('email') ?></td>
  </tr>
  <tr>
    <td colspan='2'><span style='font-weight:bold;font-size:8pt'>Leave password fields blank if you do not wish to change</span></td>
  </tr>
  <tr>
    <td>
    <?php echo $form->label('password') ?></td><td><?php echo $form->text_field('password', array('value' => '')) ?></td>
  </tr>
  <tr>
    <td><label for='v_password'>Verify Password: </td><td><input type='password' name='v_password' id='v_password' /></td>
  </tr>
  <tr>
    <td><?php echo $form->submit('Update') ?></td><td>&nbsp;</td>
  </tr>
</table>
<?php echo $form->end() ?>
<p><?php echo delete_link('Delete Account', url_for('UserController', 'delete'), true, 'Are you sure? \n This will delete all packages and remove your channel from the pear server.') ?>
<script type='text/javascript'>
	function verifyField() {
		if($F('user_password') == $F('v_password')) {
			return true;
		}
		new Effect.Highlight($('v_password'), {startcolor: '#ff0000', endcolor: '#ffffff'});
		return false;
	}
</script>
<div id='pki'>
<h2>Create a new OpenSSL Public Key</h2>
<?php echo error_messages_for($key) ?>
<?php echo $this->form = new FormFor(array('object' => $key, 'path' => url_for('UserController', 'create_key'), 'method' => 'post',
 																						'onsubmit' => "new Ajax.Request('" .
 																													url_for('UserController', 'create_key') . 
																													"',{asynchronous:true, evalScripts:true, parameters:Form.serialize(this)}); return false;")) ?>
<?php echo $this->render_partial('user/_key_form.php') ?>
<?php $this->form->end(); ?>
</div>
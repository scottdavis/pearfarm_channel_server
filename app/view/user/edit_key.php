<div id='pki'>
<h2>Editing OpenSSL Public Key: <?php echo $key->name ?></h2>
<?php echo error_messages_for($key) ?>
<?php echo $this->form = new FormFor(array('object' => $key, 'path' => url_for('UserController', 'update_key', $key->id), 'method' => 'put',
 																						'onsubmit' => "new Ajax.Request('" . 
																													url_for('UserController', 'update_key', $key->id) .
 																													"',{asynchronous:true, evalScripts:true, parameters:Form.serialize(this)}); return false;")) ?>
<?php echo $this->render_partial('user/_key_form.php') ?>
<?php $this->form->end(); ?>
</div>
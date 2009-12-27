<?php echo $this->form = new FormFor(array('object' => $key, 'path' => url_for('UserController', 'update_key', $key->id), 'method' => 'put' )) ?>
<?php echo $this->render_partial('user/_key_form.php') ?>
<?php $this->form->end(); ?>
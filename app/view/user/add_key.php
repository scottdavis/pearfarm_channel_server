<?php echo $this->form = new FormFor(array('object' => $key, 'path' => url_for('UserController', 'create_key'), 'method' => 'post' )) ?>
<?php echo $this->render_partial('user/_key_form.php') ?>
<?php $this->form->end(); ?>
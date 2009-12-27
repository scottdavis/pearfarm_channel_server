<?php echo $form = new FormFor(array('path' => url_for('UserController', 'update'), 'method' => 'put', 'object' => $user)) ?>
<table>

</table>
<?php echo $form->end() ?>

$t->string('username');
$t->string('password');
$t->string('email');
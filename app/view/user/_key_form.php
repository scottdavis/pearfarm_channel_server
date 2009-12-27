<table>
	<tr>
		<td><?php echo $form->label('name') ?></td><td><?php echo $form->text_field('name')?></td>
	</tr>
	<tr>
		<td><?php echo $form->label('key')?></td><td><?php echo $form->textarea('key', array('cols' => 100, 'rows' => 10))?></td>
	</tr>
	<tr>
		<td><?php echo $form->submit('Submit') ?></td><td></td>
	</tr>
</table>
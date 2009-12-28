<?php foreach($files as $File) { 
		$name = substr($file, strlen($file), -8);
	?>
	<p><?php echo link_to($name, url_for('HelpController', 'show', $name) ?>
<?php } ?>
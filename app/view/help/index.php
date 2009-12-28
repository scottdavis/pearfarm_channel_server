<?php foreach($files as $file) { 
		$name = substr(basename($file), 0, -9);
	?>
	<p><?php echo link_to($name, url_for('HelpController', 'show', $name)) ?></p>
<?php } ?>
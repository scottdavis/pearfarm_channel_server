<?php foreach($files as $file) { 
		$name = substr(basename($file), 0, -9);
	?>
	<p><?php echo link_to(Inflector::humanize(ucwords($name), url_for('HelpController', 'show', $name)) ?></p>
<?php } ?>
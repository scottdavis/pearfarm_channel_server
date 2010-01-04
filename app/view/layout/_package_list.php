<ul class='package_list'>
	<?php foreach($sidepackage as $_sidepackage) { 
		$vt = $_sidepackage->current_version()->version_type->name;
		?>
		<li><span class='badge <?php echo $vt ?>'>&nbsp;</span><?php echo link_to($_sidepackage->user->username . '/' . $_sidepackage->name, url_for('PackageController', 'show', $_sidepackage->user->username, $_sidepackage->name)) ?></li>
	<?php } ?>
</ul>
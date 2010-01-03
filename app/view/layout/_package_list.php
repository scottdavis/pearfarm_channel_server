<ul class='package_list'>
	<?php foreach($sidepackage as $_sidepackage) { ?>
		<li><?php echo link_to($_sidepackage->user->username . '/' . $_sidepackage->name, url_for('PackageController', 'show', $_sidepackage->id)) ?></li>
	<?php } ?>
</ul>
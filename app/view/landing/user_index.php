<h1><img src='<?php echo $user->gravatar_url('48') ?>' alt='avatar'/> <?php echo ucwords($user->username) ?></h1>
<p><?php echo ucwords($user->username) ?> Channel is: <?php echo $user->pear_farm_url() ?></p>
<h2>Packages</h2>
<ul>
<?php foreach($packages as $package) { 
		$version = $package->current_version();
		if($version === false) {continue;}
	?>
	<li><?php echo link_to(h($package->name), url_for('PackageController', 'show', $package->id)) ?> (<?php echo link_to(h($version->version), url_for('VersionController', 'show', $package->id, $version->version)) ?>)</li>
<?php
} ?>
</ul>

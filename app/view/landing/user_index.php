<h1><img src='<?php echo $user->gravatar_url('48') ?>' alt='avatar'/> <?php echo ucwords($user->username) ?></h1>
<?php if($this->is_logged_in()) { ?>
	<p><?php echo link_to('Edit Profile', url_for('UserController', 'edit')) ?>  | <?php echo link_to('Upload Package', url_for('ChannelController', 'upload')) ?></p>
	<br />
<?php } ?>
<p>Channel: <code><?php echo $user->pear_farm_url() ?></code></p>
<br />
<h2>Packages</h2>
<ul class='package_info'>
<?php foreach($packages as $package) { 
		$version = $package->current_version();
		if($version === false) {continue;}
	?>
	<li><?php echo link_to(h($package->name), url_for('PackageController', 'show', $user->username, $package->name)) ?> (<?php echo link_to(h($version->version), url_for('VersionController', 'show', $user->username, $package->name, $version->version)) ?>)</li>
<?php
} ?>
</ul>

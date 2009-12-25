<h1>Welcome <?php echo ucwords($user->username) ?></h1>
<?php echo $user->pear_farm_url() ?>
<h2>Packages</h2>
<ul>
<?php foreach($packages as $package) { ?>
	<li><?php echo $package->name ?>
			<ul>
			<?php foreach($package->versions as $version) { ?>
				<li><a href='<?php echo url_for('VersionController', 'show', $package->name, $version->version) ?>'><?php echo $version->version ?></a></li>
			<?php
  } ?>
			</ul>
	</li>
<?php
} ?>
</ul>

<a href="<?php echo url_for('ChannelController', 'upload') ?>">Upload Package</a>
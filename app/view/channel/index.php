<h1>Welcome <?php echo ucwords($user->username) ?></h1>
<p>Your Channel is: <?php echo $user->pear_farm_url() ?></p>
<h2>Packages</h2>
<ul>
<?php foreach($packages as $package) { ?>
	<li><?php echo $package->name ?>
			<ul>
			<?php foreach($package->versions as $version) { ?>
				<li><?php echo link_to($version->version, url_for('VersionController', 'show', $package->id, $version->version)) ?></li>
			<?php
  } ?>
			</ul>
	</li>
<?php
} ?>
</ul>

<a href="<?php echo url_for('ChannelController', 'upload') ?>">Upload Package</a>
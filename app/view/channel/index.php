<h1>Welcome <?php echo ucwords($user->username) ?></h1>
<p><?php echo link_to('Edit Profile', url_for('UserController', 'edit')) ?> | <?php echo link_to('Upload Package', url_for('ChannelController', 'upload')) ?></p>
<p>Your Channel is: <?php echo $user->pear_farm_url() ?></p>
<?php if($packages->length > 0) { ?>
<h2>Packages</h2>
<?php } ?>
<ul>
<?php foreach($packages as $package) { ?>
	<li><?php echo link_to($package->name, url_for('PackageController', 'show', $package->id)) ?>
	<?php if($package->versions->length == 0) {
          continue;
        }
        $max = $package->max('versions', 'version');
  ?>
			<ul>
			<?php foreach($package->versions as $version) { 
			  $url = url_for('VersionController', 'show', $package->id, $version->version);
			  if((string) $max == $version->version) {
			    $url = url_for('PackageController', 'show', $package->id);
		    }
			  ?>
				<li><?php echo link_to($version->version, $url) ?></li>
			<?php } ?>
			</ul>
	</li>
<?php
} ?>
</ul>
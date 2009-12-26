<h1><img src='<?php echo $user->gravatar_url('48') ?>' alt='avatar'/><?php echo ucwords($user->username) ?></h1>
<p><?php echo ucwords($user->username) ?> Channel is: <?php echo $user->pear_farm_url() ?></p>
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

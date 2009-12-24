<h1>Pearfarm.org</h1>
<h2>Packages</h2>
<ul>
	<?php foreach($packages as $package) { ?>
		<li><?php echo $package->name ?>
			<ul>
			<?php foreach($package->versions as $version) { ?>
				<li><?php echo $version->version ?></li>
			<?php
  } ?>
			</ul>
		</li>
	<?php
} ?>
</ul>

<p><a href='<?php echo url_for('LoginController', 'index') ?>'>Login</a></p>
<div class='border_container'>
<div id='how_to'>
	<h2>Share</h2>
	<p>Get pearfarm</p>
<code>
	pear channel-discover pearfarm.<?php echo DOMAIN ?>
</code>
<br /><br />		
<code>
	pear install pearfarm/pearfarm
</code>
	<p>Create your package spec</p>
<code>
	pearfarm init
</code>
	<p>Build your package</p>
<code>
	pearfarm build
</code>
<p>Upload</p>
<code>
	pearfarm push
</code>
</div>
<div id='doc_block'>
	<h2>Learn</h2>
	<p><?php echo link_to('Install Pear', url_for('HelpController', 'show', 'install_pear'))?></p>
	<p class='desc'>Php's packaging system</p>
	<p><?php echo link_to('Browse the Docs', 'http://pear.php.net/manual/', array('target' => '_blank'))?></p>
	<p class='desc'>The comprehensive guide on Pear packages</p>
	<p><?php echo link_to('Pearfarm Spec', url_for('HelpController', 'show', 'spec'))?></p>
	<p class='desc'>Your package's interface to the world</p>
</div>
<br style='clear:both'>
</div>
<p class='info'>Pearfarm is the Php community's pear hosting service. Instantly publish your pear packages and install them. Become a contributor and enhance the site with your own changes.</p>
<div id='packages'>
	<div id='left_col'>
	<h2>New Packages</h2>
			<?php foreach($latest as $package) { 
				$version = $package->current_version();
				if($version === false) {
				  continue;
				}
			?>
				<p><?php echo link_to($package->user->username . '/' . $package->name, url_for('PackageController', 'show', $package->id)) ?> (<?php echo $version->version ?>)</p>
			<?php
		} ?>
	</div>
	<div id='right_col'>
	<h2>Just Updated</h2>
			<?php foreach($updated as $package) { 
				$version = $package->current_version();
				if($version === false) {
				  continue;
				}
			?>
				<p><?php echo link_to($package->user->username . '/' . $package->name, url_for('PackageController', 'show', $package->id)) ?> (<?php echo $version->version ?>)</p>
			<?php
		} ?>
	</div>
	<br style='clear:both' />
</div>
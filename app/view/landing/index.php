<p class='info'>Pearfarm is the Php community's pear hosting service. Instantly publish your pear packages and install them. Become a contributor and enhance the site with your own changes.</p>
<div class='border_container'>
<div id='how_to'>
	<h2>Share</h2>
		<code>
					pear install pearfarm.<?php echo DOMAIN ?>/pearfarm
		</code>
		<p>Get pearfarm</p>
		<code>
			pearfarm init
		</code>
		<p>Create your package spec</p>
		<code>
			pearfarm build
		</code>
		<p>Build your package</p>
		<code>
			pearfarm push
		</code>
		<p>Upload</p>
		<p><?php echo link_to('Full Instructions', url_for('HelpController', 'show', 'pearfarm_howto')) ?></p>
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
<br style='clear:both;' />
</div>


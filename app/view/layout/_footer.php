		<ul class='menu_bar'>
			<li><?php echo link_to('About', url_for('HelpController', 'about')) ?></li>
			<li><?php echo link_to('FAQ', url_for('HelpController', 'show', 'FAQ')) ?></li>
			<li><?php echo link_to('Stats', url_for('HelpController', 'stats')) ?></li>
			<li><?php echo link_to('Code', "http://github.com/fgrehm/pearfarm", array('target' => '_blank')) ?></li>
			<li><?php echo link_to('Status', "http://twitter.com/pearfarm", array('target' => '_blank')) ?></li>
			<li><?php echo link_to('Blog', "http://blog.pearfarm.org", array('target' => '_blank'))?></li>
			<li><?php echo link_to('Community', "http://groups.google.com/group/pear-farm", array('target' => '_blank'))?></li>
			<li><?php echo link_to('Help', url_for('HelpController', 'index')) ?></li>
		</ul>
		<br />
		<?php echo link_to('Pearfarm.org', 'http://pearfarm.org') ?> is not associated with the <?php echo link_to('PEAR', 'http://pear.php.net') ?> project
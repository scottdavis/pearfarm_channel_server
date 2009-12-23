<ul>
<?php foreach($packages as $package) { ?>
	<li><?php echo $package->name ?>
<?php
} ?>
</ul>

<a href="<?php echo url_for('ChannelController', 'upload') ?>">Upload Package</a>
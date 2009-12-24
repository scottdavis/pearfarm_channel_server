<div id='packages'>
	<div id='left_col'>
	<h2>New Packages</h2>
			<?php foreach($latest as $package) { 
				$version = Version::find('first', array('conditoons' => array('package_id' => $package->id), 'order' => 'version DESC'));
			?>
				<p><?php echo $package->name ?> (<?php echo $version->version ?>)</p>
			<?php
		} ?>
	</div>
	<div id='right_col'>
	<h2>Just Updated</h2>
			<?php foreach($updated as $package) { 
				$version = Version::find('first', array('conditoons' => array('package_id' => $package->id), 'order' => 'version DESC'));
			?>
				<p><?php echo $package->name ?> (<?php echo $version->version ?>)</p>
			<?php
		} ?>
	</div>
	<br style='clear:both' />
</div>
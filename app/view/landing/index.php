<div id='doc_block'>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sit amet est ipsum, nec volutpat erat. Proin ornare mollis felis, et feugiat quam varius sit amet. Praesent non purus dolor, sed pulvinar felis. Mauris ut molestie diam. Ut nec ante augue. Sed viverra sapien et mi lacinia elementum. Nunc consectetur nibh orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In purus neque, tempus ac interdum non, mollis quis eros. Suspendisse blandit risus eget justo feugiat dapibus. Nam id lectus sit amet lacus porta sodales in ac arcu. Proin tempus laoreet condimentum. Pellentesque volutpat nunc vitae nulla laoreet suscipit. Maecenas elit purus, tristique vel tempor ut, sagittis in justo. Nullam nec justo orci. Curabitur elementum nisl ac lorem egestas non placerat nibh feugiat. Nulla ac diam neque, eu congue eros.
</div>
<div id='packages'>
	<div id='left_col'>
	<h2>New Packages</h2>
			<?php foreach($latest as $package) { 
				if($version = $package->current_version() === false) {
				  continue;
				}
			?>
				<p><?php echo $package->name ?> (<?php echo $version->version ?>)</p>
			<?php
		} ?>
	</div>
	<div id='right_col'>
	<h2>Just Updated</h2>
			<?php foreach($updated as $package) { 
				if($version = $package->current_version() === false) {
				  continue;
				}
			?>
				<p><?php echo $package->name ?> (<?php echo $version->version ?>)</p>
			<?php
		} ?>
	</div>
	<br style='clear:both' />
</div>
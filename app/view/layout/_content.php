<div class='main_col'>
	<h1><?php echo $this->title ?></h1>
	<div class='rounded_box'>
		<?php echo $this->content ?>
		<p><?php echo link_to_back() ?></p>
	</div>
</div>
<div class='side_col'>
	<?php foreach($sidebar as $_sidebar) { ?>
	<h2><?php echo $_sidebar['title'] ?></h2>
	<div class='rounded_box'>
		<ul class='package_list'>
    	<?php foreach($_sidebar['data'] as $_sidepackage) { 
    		$vt = $_sidepackage->current_version()->version_type->name;
    		?>
    		<li><span class='badge <?php echo $vt ?>'>&nbsp;</span><?php echo link_to($_sidepackage->user->username . '/' . $_sidepackage->name, url_for('PackageController', 'show', $_sidepackage->user->username, $_sidepackage->name)) ?></li>
    	<?php } ?>
    </ul>
	</div>
	<?php } ?>
</div>
<br style='clear:both;' />
</div>
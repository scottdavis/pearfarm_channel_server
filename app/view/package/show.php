<h1><?php echo h($this->package->name) ?></h1>
<?php echo $this->render_partial('version/_version_info.php') ?>
<h2>Versions</h2>

<?php 
$table = new SmartTable($versions, 4, '', array('id' => 'versions', 'cellspacing' => "0"));
$table->callback = function($v) use ($version) {
  $url = url_for('VersionController', 'show', $v->package_id, $v->version);
	return TagHelper::content_tag('td', link_to($v->version, $url));
};
echo $table->build();
?>
<?php if($this->is_logged_in()) {?>
<p><?php echo delete_link('Delete Package', url_for('PackageController', 'delete', $package->id), true, 'Are you sure? \n This will delete all versions of this package') ?> </p>
<?php } ?>
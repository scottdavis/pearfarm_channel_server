<h1><?php echo h($this->package->name) ?></h1>
<p><?php echo link_to(h($this->package->user->username), url_for('LandingController', 'user_index', $this->package->user->username)) ?>
<?php echo $this->render_partial('version/_version_info.php') ?>
<h2>Versions</h2>

<?php 
$table = new SmartTable($versions, 4, '', array('id' => 'versions', 'cellspacing' => "0"));

$table->callback = function($v) use ($version, $package) {
  $url = url_for('VersionController', 'show', $package->user->username, $package->name, $v->version);
	return TagHelper::content_tag('td', link_to($v->version, $url));
};
echo $table->build();
?>
<?php if($this->is_logged_in() && $this->user->id == $package->user_id) {?>
<p><?php echo delete_link('Delete Package', url_for('PackageController', 'delete', $package->id), true, 'Are you sure? \n This will delete all versions of this package') ?> </p>
<?php } ?>
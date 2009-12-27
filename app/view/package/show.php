<h1><?php echo h($this->package->name) ?></h1>
<?php echo $this->render_partial('version/_version_info.php') ?>
<h2>Versions</h2>

<?php 
$table = new SmartTable($versions, 4, '', array('id' => 'versions', 'cellspacing' => "0"));
$table->callback = function($v) use ($version) {
  $url = url_for('VersionController', 'show', $v->package_id, $v->version);
  if($version->version == $v->version) {
    $url = url_for('PackageController', 'show', $v->package_id); 
  }
	return TagHelper::content_tag('td', link_to($v->version, $url));
};
echo $table->build();
?>

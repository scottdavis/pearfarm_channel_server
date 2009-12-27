<h1>Details: <?php echo $package->name ?> - <?php echo $version->version ?></h1>
<?php echo $this->render_partial('version/_version_info.php') ?>
<p><?php echo delete_link('Delete Version', url_for('VersionController', 'delete', $package->id, $version->id)) ?> </p>
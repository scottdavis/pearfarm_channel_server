<h1><?php echo h($this->package->name) ?></h1>
<h2>Versions</h2>
<?php foreach($versions as $this->version) {
  $this->data = unserialize($this->version->meta);
  echo $this->render_partial('version/_version_info.php');
} ?>
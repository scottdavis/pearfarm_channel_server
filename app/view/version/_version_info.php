<p>To install this package</p>
<code>
	pear install <?php echo $package->user->pear_farm_url() ?>/<?php echo $package->name ?>-<?php echo $version->version ?>
</code>
<p><?php echo link_to('Download this package', $package->file_url($version->version) . '.tgz') ?></p>
<?php if (!empty($data)) { ?>
	<ul>
		<li>Channel: <?php echo h($data['channel']) ?></li>
		<li>Summary: <?php echo h($data['summary']) ?></li>
		<li>Description: <?php echo h($data['description']) ?></li>
		<li>Version: <ul>
									<li>Release: <?php echo h($data['version']['release']) ?></li>
									<li>Api: <?php echo h($data['version']['api']) ?></li>
									</ul>
		</li>
		<li>Stability: <ul>
									<li>Release: <?php echo h($data['stability']['release']) ?></li>
									<li>Api: <?php echo h($data['stability']['api']) ?></li>
									</ul>
		</li>
		<li>Maintainers:
		<?php foreach(array('lead', 'developer', 'contributor', 'helper') as $type) {
    if (!isset($data[$type])) {
      continue;
    }
?>
			<ul>
				<?php if (is_assoc($data[$type])) { ?>
					<li><?php echo ucwords($type) ?>: <?php echo h($data[$type]['name']) ?> - <?php echo h($data[$type]['email']) ?></li>
				<?php
    } else {
      foreach($data[$type] as $lead) {
?>
					<li>Lead: <?php echo h($lead['name']) ?> - <?php echo h($lead['email']) ?></li>
				<?php
      }
    } ?>
				
			</ul>
		<?php
  } ?>
		</li>
		<li>License: <?php echo h($data['license']['_content']) ?></li>
		<li>Notes: <?php echo h($data['notes']) ?></li>
	</ul>
<?php
} ?>

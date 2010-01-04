<p>To install this package</p>
<code>
	pear install <?php echo $package->user->pear_farm_url() ?>/<?php echo $package->name ?>-<?php echo $version->version ?>
</code>

<?php if (!empty($data)) { ?>
	<ul class='package_info'>
		<li><span class='title'>Channel:</span> <?php echo h($data['channel']) ?></li>
		<li><span class='title'>Summary:</span> <?php echo $data['summary'] ?></li>
		<li><span class='title'>Description:</span> <?php echo $data['description'] ?></li>
		<li><span class='title'>Version:</span> <ul>
									<li><span class='title'>Release:</span> <?php echo h($data['version']['release']) ?></li>
									<li><span class='title'>Api:</span> <?php echo h($data['version']['api']) ?></li>
									</ul>
		</li>
		<li><span class='title'>Stability:</span> <ul>
									<li><span class='title'>Release:</span> <?php echo h($data['stability']['release']) ?></li>
									<li><span class='title'>Api:</span> <?php echo h($data['stability']['api']) ?></li>
									</ul>
		</li>
		<li><span class='title'>Maintainers:</span>
		<?php foreach(array('lead', 'developer', 'contributor', 'helper') as $type) {
    if (!isset($data[$type])) {
      continue;
    }
?>
			<ul>
				<?php if (is_assoc($data[$type])) { ?>
					<li><span class='title'><?php echo ucwords($type) ?>:</span> <?php echo h($data[$type]['name']) ?> - <?php echo h($data[$type]['email']) ?></li>
				<?php
    } else {
      foreach($data[$type] as $lead) {
?>
					<li><span class='title'><?php echo ucwords($type) ?>:</span> <?php echo h($lead['name']) ?></li>
				<?php
      }
    } ?>
				
			</ul>
		<?php
  } ?>
		</li>
		<li><span class='title'>License:</span> <?php echo h($data['license']['_content']) ?></li>
		<li><span class='title'>Notes:</span> <?php echo h($data['notes']) ?></li>
	</ul>
<?php
} ?>

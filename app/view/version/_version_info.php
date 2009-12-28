<p>To install this package</p>
<code>
	pear install <?php echo $package->user->pear_farm_url() ?>/<?php echo $package->name ?>-<?php echo $version->version ?>
</code>
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
					<li><?php echo ucwords($type) ?>: <?php echo $data[$type]['name'] ?> - <?php echo $data[$type]['email'] ?></li>
				<?php
    } else {
      foreach($data[$type] as $lead) {
?>
					<li>Lead: <?php echo $lead['name'] ?> - <?php echo $lead['email'] ?></li>
				<?php
      }
    } ?>
				
			</ul>
		<?php
  } ?>
		</li>
		<li>License: <?php echo $data['license']['_content'] ?></li>
		<li>Notes: <?php echo $data['notes'] ?></li>
		<li>Dependecies:
		<?php foreach(array('required', 'optional') as $d_type) { ?>
			<?php if (isset($data[$d_type]) && is_array($data[$d_type]['package'])) {
      foreach($data[$d_type]['package'] as $package) { ?>
								<ul>
									<li>Name: <?php echo $package['name'] ?></li>
									<li>Channel: <?php echo $package['channel'] ?></li>
									<li>Min: <?php echo $package['min'] ?></li>									
								</ul>
							<?php
      } ?>
			<?php
    } elseif (isset($data[$d_type])) {
      $package = $data[$d_type];
?>
				<ul>
					<li>Name: <?php echo $package['name'] ?></li>
					<li>Channel: <?php echo $package['channel'] ?></li>
					<li>Min: <?php echo $package['min'] ?></li>									
				</ul>
			<?php
    } ?>
		<?php
  } ?>
		</li>
	</ul>
<?php
} ?>

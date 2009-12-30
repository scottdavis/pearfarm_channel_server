<table id='search_table' cellspacing="0">
  <thead>
    <tr class='odd'>
      <th>Name</th>
      <th>User</th>
      <th>Description</th>
      <th>Php Version</th>
      <th>Last Updated</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($packages as $package) { 
      $version = $package->current_version();
			if($version === false) {
				continue;
			}
      ?>
      <tr class="<?php echo cycle('even', 'odd') ?>">
        <td><?php echo link_to(h($package->name), url_for("PackageController", 'show', $package->id)) ?></td>
        <td>
            <img width='16px' src='<?php echo $package->user->gravatar_url() ?>' alt='avatar'/>
            <?php echo $package->user->username ?>
        </td>
        <td><?php echo $version->description ?></td>
        <td><?php echo $version->min_php ?></td>
        <td><?php echo $package->updated_at ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<div id='pagination'>
	<?php echo paginate($packages) ?>
</div>
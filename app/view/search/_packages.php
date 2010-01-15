<table id='search_table' cellspacing="0">
  <thead>
    <tr class='odd'>
      <th>Name</th>
			<th>Current Version</th>
      <th>Summary</th>
      <th>Php Version</th>
      <th>Last Updated</th>
			<th>Rating</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($packages as $package) { 
      $version = $package->current_version();
			$vt = $version->version_type->name;
			if($version === false) {
				continue;
			}
      ?>
      <tr class="<?php echo cycle('even', 'odd') ?>">
        <td><span class='badge <?php echo $vt ?>' style='margin-left:5px;'>&nbsp;</span><?php echo link_to(h($package->user->username . '/' .$package->name), url_for("PackageController", 'show', $package->user->username, $package->name)) ?></td>
				<td><div class='summary-right'><?php echo link_to($version->version, url_for("VersionController", 'show', $package->user->username, $package->name, $version->version)) ?></div></td>
        <td><div class='small summary-right'><?php echo $version->summary ?></div></td>
        <td><?php echo $version->min_php ?></td>
        <td><?php echo distance_of_time_in_words(DateHelper::from_db($package->updated_at), time(), true) ?> ago</td>
				<td><?php echo isset($package->rating) ? PackageRating::convert_to_human($package->rating) : 0 ?>%</td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<div id='pagination'>
	<?php echo paginate($packages) ?>
</div>
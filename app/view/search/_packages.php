<table id='search_table' cellspacing="0">
  <thead>
    <tr class='odd'>
      <th>Name</th>
      <th>Summary</th>
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
        <td>
						<table>
							<tr>
								<td><img width='16px' src='<?php echo $package->user->gravatar_url() ?>' alt='avatar'/></td>
            		<td><?php echo link_to(h($package->user->username . '/' .$package->name), url_for("PackageController", 'show', $package->user->username, $package->name)) ?></td>
							</tr>
						</table>
        </td>
        <td><span class='small'><?php echo $version->summary ?></span></td>
        <td><?php echo $version->min_php ?></td>
        <td><span class='small'><?php echo distance_of_time_in_words(DateHelper::from_db($package->updated_at), time(), true) ?> ago</span></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<div id='pagination'>
	<?php echo paginate($packages) ?>
</div>
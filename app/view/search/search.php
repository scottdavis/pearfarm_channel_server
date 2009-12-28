<h1> Search Results: <?php echo $_GET['search'] ?></h1>
<?php if(count($packages) == 0) { ?>
  <p> No packages where found using keyword: "<?php echo $_GET['search'] ?>", please refine your search and try again.</p>
<?php }else{ ?>
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
        $version = Version::find('first', array('select' => 'description,min_php','conditions' => array('package_id' => $package->id)));
        ?>
        <tr class="<?php echo cycle('even', 'odd') ?>">
          <td><?php echo $package->name ?></td>
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
	<?php paginate($packages) ?>
<?php } ?>
<?xml version="1.0" encoding="utf-8" ?>
<f xmlns="http://pear.php.net/dtd/rest.categorypackageinfo"
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
   xmlns:xlink="http://www.w3.org/1999/xlink"
   xsi:schemaLocation="http://pear.php.net/dtd/rest.categorypackageinfo
                       http://pear.php.net/dtd/rest.categorypackageinfo.xsd"
>

<?php foreach($this->packages as $package) { 
	$version_data = $package->versions->first()->package_data();
	$versions = $package->versions;
?>
 <pi>
  <p>
   <n><?php echo $package->name ?></n>
   <c><?php echo $user->pear_farm_url() ?></c>
   <ca xlink:href="<?php echo $category->link() ?>"><?php echo $category->name ?></ca>
	 <l><?php echo $version_data['license']['_content'] ?></l>
	 <s><?php echo $version_data['summary'] ?></s>
	 <d><?php echo $version_data['description'] ?></d>
	 <r xlink:href="/rest/r/<?php echo urlencode($package->name) ?>"/>
  </p>
  <a>
	<?php foreach($versions as $version) { ?>
   <r><v><?php echo $version->version ?></v><s><?php echo $version->version_type->name ?></s></r>
	<?php } ?>
  </a>
		<?php foreach($versions as $version) { 
			$data = $version->package_data();
			?>
  	<deps>
   		<v><?php echo $version->version ?></v>
   		<d><?php echo serialize($data['dependencies']) ?></d>
  		</deps>
		<?php } ?>
 </pi>
<?php } ?>
</f>
<?xml version="1.0" encoding="utf-8" ?>
<a xmlns="http://pear.php.net/dtd/rest.allreleases2"
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
   xmlns:xlink="http://www.w3.org/1999/xlink"
   xsi:schemaLocation="http://pear.php.net/dtd/rest.allreleases2
                       http://pear.php.net/dtd/rest.allreleases2.xsd"
>
 <p><?php echo $package->name ?></p>
 <c><?php echo $user->pear_farm_url() ?></c>
<?php foreach($versions as $verison) { 
  $data = unserialize($verison->meta);
  ?>
 <r><v><?php echo $verison->version ?></v><s><?php echo $verison->version_type->name ?></s><m><?php echo $data['dependencies']['required']['php']['min'] ?></m></r>
<?php } ?>
</a>
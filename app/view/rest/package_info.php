<?xml version="1.0" encoding="utf-8" ?>
<p xmlns="http://pear.php.net/dtd/rest.package"
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
   xmlns:xlink="http://www.w3.org/1999/xlink"
   xsi:schemaLocation="http://pear.php.net/dtd/rest.package
                       http://pear.php.net/dtd/rest.package.xsd"
>
 <n><?php echo $package->name ?></n>
 <c><?php echo $user->pear_farm_url() ?></c>
 <ca xlink:href="/rest/c/<?php echo $package->category->name ?>"><?php echo $package->category->name ?></ca>
 <l><?php echo $data['license']['_content'] ?></l>
 <s><?php echo $data['summary'] ?></s>
 <d><?php echo $data['description'] ?></d>
 <r xlink:href="/rest/r/<?php echo urlencode($package->name) ?>"/>
</p>
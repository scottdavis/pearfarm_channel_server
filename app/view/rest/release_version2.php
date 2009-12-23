<?xml version="1.0" encoding="utf-8" ?>
<r xmlns="http://pear.php.net/dtd/rest.release"
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
   xmlns:xlink="http://www.w3.org/1999/xlink"
   xsi:schemaLocation="http://pear.php.net/dtd/rest.release
                       http://pear.php.net/dtd/rest.release.xsd"
>
 <p xlink:href="<?php echo $package->link() ?>"><?php echo $package->name ?></p>
 <c><?php echo $user->pear_farm_url() ?></c>
 <v><?php echo $version->version ?></v>
 <a><?php echo $data['version']['api'] ?></a>
 <mp><?php echo $data['dependencies']['required']['php']['min'] ?></mp>
 <st><?php echo $version->version_type->name ?></st>
 <l><?php echo $data['license']['_content'] ?></l>
 <m><?php echo $user->username ?></m>
 <s><?php $data['summary'] ?></s>
 <d><?php $data['description'] ?></d>
 <da><?php echo $data['date'] . ' ' . $data['time'] ?></da>
 <n><?php $data['notes'] ?></n>
 <f><?php echo filesize($package->file_path($version->version)) ?></f>
 <g><?php echo $package->file_url($version->version) ?></g>
 <x xlink:href="<?php echo $package->name ?>.<?php echo $version->version ?>.xml"/>
</r>
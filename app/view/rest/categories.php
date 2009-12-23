<?xml version="1.0" encoding="utf-8" ?>
<a xmlns="http://pear.php.net/dtd/rest.allcategories"
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
   xmlns:xlink="http://www.w3.org/1999/xlink"
   xsi:schemaLocation="http://pear.php.net/dtd/rest.allcategories
                       http://pear.php.net/dtd/rest.allcategories.xsd"
>
 <ch><?php echo $user->pear_farm_url() ?></ch>
<?php foreach($categories as $cat) { ?>
 <c xlink:href="<?php echo $cat->link() ?>"><?php echo $cat->name ?></c>
<?php
} ?>
</a>
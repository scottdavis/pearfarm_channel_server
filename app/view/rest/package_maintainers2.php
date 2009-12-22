<?xml version="1.0" encoding="utf-8" ?>
<m xmlns="http://pear.php.net/dtd/rest.packagemaintainers"
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
   xmlns:xlink="http://www.w3.org/1999/xlink"
   xsi:schemaLocation="http://pear.php.net/dtd/rest.packagemaintainers
                       http://pear.php.net/dtd/rest.packagemaintainers.xsd"
>
 <p>WorldDominator</p>
 <c>pear.example.org</c>
<?php foreach($maintainers as $m) { ?>
 <m>
  <h><?php echo $m['name'] ?></h>
  <a><?php echo ($m['active'] == 'yes') ? '1' : '0' ?></a>
	<r><?php echo $m['role'] ?></r>
 </m>
<?php } ?>
</m>
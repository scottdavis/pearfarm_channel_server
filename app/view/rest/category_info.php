<?xml version="1.0" encoding="utf-8" ?>
<c xmlns="http://pear.php.net/dtd/rest.category"
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
   xmlns:xlink="http://www.w3.org/1999/xlink"
   xsi:schemaLocation="http://pear.php.net/dtd/rest.category
                       http://pear.php.net/dtd/rest.category.xsd"
>
 <n><?php echo $category->name ?></n>
 <c><?php echo $user->pear_farm_url() ?></c>
 <a><?php echo $category->alias() ?></a>
 <d><?php echo $category->description ?></d>
</c>
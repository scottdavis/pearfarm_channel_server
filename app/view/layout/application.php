<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo h(Nimble::get_title()) ?></title>
</head>
<body>
	 <?php if (isset($_SESSION['flashes']['notice']) && !empty($_SESSION['flashes']['notice'])) { ?>
    <div id='flash'>
            <?php echo Nimble::display_flash('notice'); ?>
    </div>
    <?php
} ?>
	<?php echo $content ?>
</body>
</html>

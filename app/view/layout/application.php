<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<link rel="Shortcut Icon" href="/public/image/favico.ico" />
	<link rel="icon" href="/public/image/favico.ico" type="image/x-icon" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo h(Nimble::get_title()) ?></title>
	<?php echo stylesheet_link_tag('style.css') ?>
	<script type='text/javascript' src="http://www.google.com/jsapi"></script>
	<script type='text/javascript'>
	 	google.load("prototype", "1.6");
	  google.load("scriptaculous", "1.8.3");
	</script>
	</head>
	<body>
		<div id="header">
			<div id='head2'>
					<div id="searchbox">
						<p><input id='searchbox_form' type='text' /></p>
					</div>
				<div id='header_content'>
					<a href='/'><img src='/public/image/logo.png' alt='logo' /></a>
						<?php if(is_logged_in()) {?>
							<p><a href='<?php echo url_for('LoginController', 'logout') ?>'>Logout</a></p>
						<?php }else{ ?>
							<p><a href='<?php echo url_for('LoginController', 'index') ?>'>Login</a> | <a href='<?php echo url_for('LoginController', 'add') ?>'>Sign Up</a></p>
						<?php } ?>
				</div>
						<br style='clear:both' />
			</div>
		</div>
			<?php if (isset($_SESSION['flashes']['notice']) && !empty($_SESSION['flashes']['notice'])) { ?>
				<div id='flash' class='notice'>
					<?php echo Nimble::display_flash('notice'); ?>
				</div>
			<?php } ?>
		<div id='content'>
			<?php echo $content ?>
		</div>
		<?php echo javascript_include_tag('application.js') ?>
	</body>
</html>

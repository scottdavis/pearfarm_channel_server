<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="Shortcut Icon" href="/public/image/favico.ico" />
	<link rel="icon" href="/public/image/favico.ico" type="image/x-icon" />
	<link rel="search" type="application/opensearchdescription+xml" href="http://<?php echo DOMAIN ?>/opensearch.xml" title="Pearfarm" /> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo h(Nimble::get_title()) ?></title>
	<?php echo stylesheet_link_tag('style.css', 'facebox.css') ?>
	<!--[if lt IE 7]>
	  <?php echo javascript_include_tag('pngfix.js') ?>
  <![endif]-->
	<?php echo javascript_include_tag('prototype.js', 'scriptaculous.js', 'facebox.js') ?>
	<script type='text/javascript'>
		Event.observe(window, 'load', function(){
			facebox = new Facebox({loading_image: '/public/image/facebox/loading.gif', close_image: '/public/image/facebox/closelabel.gif'});
			$('searchbox_form').observe('focus', function(){
				$('searchbox_form').clear();
			});
		});
	</script>
	</head>
	<body>
		<div id="header">
			<div id='head2'>
					<div id="searchbox_holder">
						<ul>
						<?php if($this->is_logged_in()) {?>
							<li><?php echo link_to('Logout', url_for('LoginController', 'logout')) ?></li>
						<?php }else{ ?>
							<li><?php echo link_to('Login', url_for('LoginController', 'index')) ?></li> 
							<li><?php echo link_to('Sign Up', url_for('LoginController', 'add')) ?></li>
						<?php } ?>
						</ul>
					  <form action='/search' method='get' />
							<div id="searchbox">
						  	<input id='searchbox_form' type='text' name='search' value='<?php echo (isset($_GET['search'])) ? $_GET['search'] : 'Search packages…' ?>' />
						  </div>
						</form>
					</div>
				<div id='header_content'>
					<a href='/'><img src='/public/image/logo.png' alt='logo' /></a>
				</div>
				<br style='clear:both' />
			</div>
		</div>
			<?php if (isset($_SESSION['flashes']['notice']) && !empty($_SESSION['flashes']['notice'])) { ?>
				<div id='flash' class='notice'>
					<?php echo Nimble::display_flash('notice'); ?>
				</div>
			<?php } ?>
			<div id='fold'>
				<div class='left'>
					<div id='count' >
						<strong><?php echo $this->total_packages ?> packages</strong>
						<br />
						Since Dec 2009
					</div>
				</div>
				<div class='right fold-right'>
				<strong><?php echo link_to('Gemcutter', 'http://www.gemcutter.org', array('target' => '_blank')) ?>for PHP.</strong>
				<br />
				Find code easier, publish it faster, and have fun doing it.
				</div>
				<br style='clear:both' />
			</div>
		<div id='content'>
			<?php echo $content ?>
			<p><?php echo link_to_back() ?></p>
		</div>
		<?php if(NIMBLE_ENV == 'staging' || NIMBLE_ENV == 'production') { ?>
   	 <script type="text/javascript">
	    	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		    </script>
		    <script type="text/javascript">
		    try {
		      var pageTracker = _gat._getTracker("UA-5410969-8");
		      pageTracker._trackPageview();
		    } catch(err) {}
			</script>
			<?php } ?>
  </body>
</html>

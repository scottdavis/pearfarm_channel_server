<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="Shortcut Icon" href="/public/image/favico.ico" />
	<link rel="icon" href="/public/image/favico.ico" type="image/x-icon" />
	<link rel="search" type="application/opensearchdescription+xml" href="http://<?php echo DOMAIN ?>/opensearch.xml" title="Pearfarm" /> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="google-site-verification" content="griVQ0kTz8ri_7TzrEN8bOALKwWT8g2fgbow_3GsDQM" />
	<meta name="description" content="Pearfarm is the Php community's pear hosting service. Instantly publish your pear packages and install them. Become a contributor and enhance the site with your own changes." /> 
	<meta name="keywords" content="php pear packages community code repository opensource" />
	<title><?php echo h(Nimble::get_title()) ?></title>
	<?php echo stylesheet_link_tag('stylesheet.css', 'facebox.css') ?>
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
		<div id="top_header">
			<div id='header'>
				<a id='logo_link' title='pearfarm' href='http://<?php echo DOMAIN ?>/'>
				<div id='logo'>
						<div id='total_count'><?php echo $this->total_packages ?> Packages since Dec 09</div>
				</div>
				</a>
				<div id='main_menu'>
					<div id="searchbox_holder">
						<ul class='menu_bar'>
							<li><?php echo link_to('All Packages', url_for('PackageController', 'index')) ?></li>
						<?php if($this->is_logged_in()) {?>
							<li><?php echo link_to('Profile', url_for('LandingController', 'user_index', $this->user->username)) ?></li>
							<li><?php echo link_to('Logout', url_for('LoginController', 'logout')) ?></li>
						<?php }else{ ?>
							<li><?php echo link_to('Login', url_for('LoginController', 'index')) ?></li> 
							<li><?php echo link_to('Sign Up', url_for('LoginController', 'add')) ?></li>
						<?php } ?>
						</ul>
					  <form action='/search' method='get'>
							<div id="searchbox">
						  	<input id='searchbox_form' type='text' name='search' value='<?php echo (isset($_GET['search'])) ? $_GET['search'] : 'Search packages…' ?>' />
						  </div>
						</form>
						<div style='text-align:right;margin-top:5px;margin-right:10px;'>
						<a href='http://www.pledgie.com/campaigns/7658'>
							<img alt='Click here to lend your support to: Hosting &amp; Bandwidth and make a donation at www.pledgie.com !' src='http://www.pledgie.com/campaigns/7658.png?skin_name=chrome' border='0' /></a>
						</div>
					</div>
				</div>
				<br style='clear:both;' />
			</div>
		</div>
		<div id='wrapper'>
			<div id='content'>
				<?php $this->show_flash() ?>
				<?php if($this->full == false) {?>
					<?php echo $this->render_partial('layout/_content.php') ?>
				<?php }else{?>
					<?php echo $this->render_partial('layout/_full.php') ?>
				<?php } ?>
			</div>
		</div>
		<div id='footer'>
			<?php echo $this->render_partial('layout/_footer.php') ?>
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

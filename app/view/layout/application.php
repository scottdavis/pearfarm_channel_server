<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="Shortcut Icon" href="/public/image/favico.ico" />
	<link rel="icon" href="/public/image/favico.ico" type="image/x-icon" />
	<link rel="search" type="application/opensearchdescription+xml" href="http://<?php echo DOMAIN ?>/opensearch.xml" title="Pearfarm" /> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
				<div id='logo'>
					<a href='/'><img src='/public/image/assets/logo.png' alt='logo' /></a>
				</div>
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
				<div class='main_col'>
					<h1><?php echo $this->title ?></h1>
					<div class='rounded_box'>
						<?php echo $content ?>
						<p><?php echo link_to_back() ?></p>
					</div>
				</div>
				<div class='side_col'>
					<?php foreach($sidebar as $_sidebar) { ?>
					<h2><?php echo $_sidebar['title'] ?></h2>
					<div class='rounded_box'>
						<?php echo $_sidebar['content'] ?>
					</div>
					<?php } ?>
				</div>
				<br style='clear:both;' />
			</div>
		</div>
		<div id='footer'>
				<ul class='menu_bar'>
					<li><?php echo link_to('About', url_for('HelpController', 'about')) ?></li>
					<li><?php echo link_to('FAQ', url_for('HelpController', 'show', 'FAQ')) ?></li>
					<li><?php echo link_to('Stats', url_for('HelpController', 'stats')) ?></li>
					<li><?php echo link_to('Code', "http://github.com/fgrehm/pearfarm", array('target' => '_blank')) ?></li>
					<li><?php echo link_to('Status', "http://twitter.com/pearfarm", array('target' => '_blank')) ?></li>
					<li><?php echo link_to('Community', "http://groups.google.com/group/pear-farm", array('target' => '_blank'))?></li>
					<li><?php echo link_to('Help', url_for('HelpController', 'index')) ?></li>
				</ul>
				<br />
				<?php echo link_to('Pearfarm.org', 'http://pearfarm.org') ?> is not associated with the <?php echo link_to('PEAR', 'http://pear.php.net') ?> project
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

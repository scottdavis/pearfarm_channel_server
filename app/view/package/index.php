<h1> Packages </h1>
<?php if(count($packages) == 0) { ?>
  <p> No packages where found. </p>
<?php }else{ ?>
	<?php echo $this->render_partial('search/_packages.php'); ?>
<?php } ?>
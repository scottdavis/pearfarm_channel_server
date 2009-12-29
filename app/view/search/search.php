<h1> Search Results: <?php echo $_GET['search'] ?></h1>
<?php if(count($packages) == 0) { ?>
  <p> No packages where found using keyword: "<?php echo $_GET['search'] ?>", please refine your search and try again.</p>
<?php }else{ ?>
	<?php echo $this->render_partial('search/_packages.php'); ?>
<?php } ?>
<div class='main_col'>
	<h1><?php echo $this->title ?></h1>
	<div class='rounded_box'>
		<?php echo $this->content ?>
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
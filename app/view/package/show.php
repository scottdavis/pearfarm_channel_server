<?php echo javascript_include_tag('rater.js') ?>
<div id='package_title_bar'>
<div class='left'>
	<table>
		<tr>
			<td><img src='/public/image/assets/<?php echo $version->version_type->name ?>_badge_48.png'></td>
			<td><span class='version_type'><?php echo ucwords($version->version_type->name) ?></span> - <?php echo $package->current_version()->version ?></td>
		</tr>
	</table>
</div>
<div class='right'>
	<p><?php echo link_to('Download', $package->file_url($version->version) . '.tgz', array('class' => 'download')) ?></p>
	<p>
		<div id='rater'></div>
		<script type='text/javascript'>new Rater($('rater'), raterLayout.stars, {bg:'#eeeeee', ratingto:'/package/rait/%score%'});</script>
	</p>
</div>
<br style='clear:both;' />
</div>
<p>Downloaded: <?php echo $package->num_downloads ?> times.</p> 
<?php if($this->is_logged_in() && $this->user->id == $package->user_id) {?>
	<p>Website: <span id='website'><?php echo empty($package->url) ? 'click to edit' : $package->url ?></span></p>
	<script type='text/javascript'>
		new Ajax.InPlaceEditor($('website'), '/package/website/<?php echo $package->id ?>/edit');
	</script>
<?php }else{ ?>
	<?php if(!is_null($package->url) && !empty($package->url) || $package->url != 'NULL') { ?>
		<p>Website: <a href='<?php echo $package->url ?>' target='_blank'><?php echo $package->url ?></a></p>
	<?php } ?>
<?php } ?>
<br />
<h3>Install this package</h3>
<code>
	pear install <?php echo $package->user->pear_farm_url() ?>/<?php echo $package->name ?>-<?php echo $version->version ?>
</code>
<br />
<br />
<div id='summary'>
	<?php echo $data['summary'] ?>
</div>
<br />
<br />
<div id='maintainers'>
<h3>Maintainers:</h3>
<?php foreach(array('lead', 'developer', 'contributor', 'helper') as $type) {
if (!isset($data[$type])) {
  continue;
}
?>
	<ul class='maintainer_info'>
		<?php if (is_assoc($data[$type])) { ?>
			<li><span class='title'><?php echo ucwords($type) ?>:</span> <?php echo h($data[$type]['name']) ?> - <?php echo h($data[$type]['user']) ?></li>
		<?php
} else {
  foreach($data[$type] as $lead) {
?>
			<li><span class='title'><?php echo ucwords($type) ?>:</span> <?php echo h($lead['name']) ?></li>
		<?php
  }
} ?>
		
	</ul>
<?php } ?>
</div>

<h3>Versions</h3>
<p>Showing <?php echo $versions->length ?> of <?php echo $total_versions ?></p>
<ul class='versions'>
<?php foreach($versions as $_version) { 
  $url = url_for('VersionController', 'show', $package->user->username, $package->name, $_version->version);
?>
<li><?php echo link_to($_version->version, $url) ?></li>
<?php } ?>
</ul>

<?php if($this->is_logged_in() && $this->user->id == $package->user_id) {?>
<div>
	<div class='right'>
		<p><?php echo delete_link('Delete Package', url_for('PackageController', 'delete', $package->id), true, 'Are you sure? \n This will delete all versions of this package') ?> </p>
	</div>
</div>
<br style='clear:both;'/>
<?php } ?>
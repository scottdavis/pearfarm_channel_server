<h1>Upload a new package</h1>
<form method='post' action='<?php echo url_for('ChannelController', 'upload') ?>' enctype="multipart/form-data">
	<p><label for='file'>File: </label><input type='file' id='file' name='file' /></p>
	<p><input type='hidden' name='upload_key', value='<?php echo $this->key ?>' /><input type='submit' value='upload'></p>
</form>
<p><a href="/">Back</a></p>
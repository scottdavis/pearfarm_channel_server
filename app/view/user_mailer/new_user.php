Welcome, <?php echo $user->username ?>

Please click the link below to verify your account at <?php echo DOMAIN ?>
<br />
<a href="http://<?php echo DOMAIN ?><?php echo url_for('LoginController', 'verify', $user->api_key) ?>">ttp://<?php echo DOMAIN ?><?php echo url_for('LoginController', 'verify', $user->api_key) ?></a>
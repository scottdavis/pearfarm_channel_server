#!/usr/bin/env php
<?php
define("CLI_RUNNER", true);

require_once(__DIR__ . '/../config/boot.php');
$logFile = __DIR__ . '/test.log';
$fp      = fopen($logFile,"a+");
$stdin   = fopen("php://stdin", "r");

// Use unbuffered output
ob_implicit_flush (true);

while ($line = fgets($stdin))
{
  doPackage($line);
  fwrite($fp, $line);
}

fclose($fd);
fclose($stdin);

  function doPackage($file_name) {
    global $fp;
    $path = explode(DIRECTORY_SEPARATOR, $file_name);
    $file = array_pop($path);
    $username = array_pop($path);
    $package_split = explode('-', $file);
    $name = $package_split[0];
    try{
      $user = User::find_by_username($username);
      $package = Package::find('first', array('conditions' => array('user_id' => $user->id, 'name' => $name)));
      $current = (int) $package->num_downloads;
      $package->num_downloads = $current + 1;
      $package->save();
    }catch(Exception $e) {
      fwrite($fp, NIMBLE_ENV . " log failed\n" . $e->getMessage() . "\n");
      return;
    }
  }






?>
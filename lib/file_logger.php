#!/usr/bin/env php
<?php
define("CLI_RUNNER", true);
$_SERVER['WEB_ENVIRONMENT'] = 'production';
require_once(__DIR__ '/../config/boot.php');
$logFile = __DIR__ . '/test.log';
$fp      = fopen($logFile,"a+");
$stdin   = fopen("php://stdin", "r");

// Use unbuffered output
ob_implicit_flush (true);

while ($line = fgets($stdin))
{
   fwrite($fp, basename($line));
}

fclose($fd);
fclose($stdin);




  function doPackage($file_name) {
    $path = explode(DIRECTORY_SEPARATOR, $file_name);
    $file = array_pop($path);
    $username = array_pop($path);
    User::find_by_username($username);
    
  }






?>
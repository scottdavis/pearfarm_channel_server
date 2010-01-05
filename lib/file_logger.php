#!/usr/bin/env php
<?php
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
?>
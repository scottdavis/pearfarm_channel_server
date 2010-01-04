<?php
define("CLI_RUNNER", true);
require_once('nimblize/nimble_support/lib/command_line_colors.php');
require_once('nimblize/nimble_record/migrations/lib/migration_runner.php');
require_once('nimblize/nimble_record/migrations/migration.php');
$nimble_root = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..';
require_once(join(DIRECTORY_SEPARATOR, array($nimble_root, 'config', 'boot.php')));
MigrationRunner::$dir = FileUtils::join(NIMBLE_ROOT, 'db', 'migrations');
$storyhelper_path = FileUtils::join(NIMBLE_ROOT, 'lib', 'story_helper.php');
if(file_exists($storyhelper_path)){
	require_once($storyhelper_path);
}
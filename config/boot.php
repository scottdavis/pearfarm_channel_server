<?php
	session_start();
	
	/**
	* This file boots and loads the framework
	* In order for the enviroments to work correctly add the line below to your server apache config
	* depending on which enviroment you want to load replace <enviroment> with development | production | test | staging | etc.
	* note this can also be done at the vhost level so you cna run multiple enviroments on one machine.
	* If you are on shared hosting ignore this and just uncomment the $_SERVER['WEB_ENVIRONMENT'] = <enviroment> line below
	*  # Set an environment variable for nimble
	*  SetEnv WEB_ENVIRONMENT <enviroment>
	*/
	
	//$_SERVER['WEB_ENVIRONMENT'] = 'development';
	//$_SERVER['WEB_ENVIRONMENT'] = 'test';
	//$_SERVER['WEB_ENVIRONMENT'] = 'staging';
	//$_SERVER['WEB_ENVIRONMENT'] = 'production';
	
	
	/** SHOULD NEVER NEED TO CHANGE BELOW THIS LINE 
		* ALL CHANGES SHOULD BE MADE IN the config.php files
	**/
	
	
	
	$env = getenv('NIMBLE_ENV');
	if(!empty($env)) {
		$_SERVER['WEB_ENVIRONMENT'] = strtolower($env);
	}
	
	
	if(!isset($_SERVER['WEB_ENVIRONMENT'])) {
		$_SERVER['WEB_ENVIRONMENT'] = 'development';
	}
	//set ENV as constant
	define('NIMBLE_ENV', $_SERVER['WEB_ENVIRONMENT']);
	
	
	
	/**
	* @param $dir string 
	* loads the controller and model classes
	*/
	function __load_files($dir) {
		if (is_dir($dir)) {
			foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file) {
				if(preg_match('/\.php$/' , $file)) {
					require_once($file);
				}
			}
		}
	}
	
	/** load nimble */
	require_once('nimblize/nimblize.php');
	/** Set the path to the view templates */
	Nimble::set_config('view_path', FileUtils::join(dirname(__FILE__), '..', 'app', 'view'));
	/** set the default plugin path */
	Nimble::set_config('plugins_path', FileUtils::join(dirname(__FILE__) , '..', 'plugin'));
	Nimble::set_config('default_layout', FileUtils::join(Nimble::getInstance()->config['view_path'], 'layout', 'application.php'));
	/** set asset path change this in your config.php to override */
	Nimble::set_config('stylesheet_folder', FileUtils::join(dirname(__FILE__), '..', 'public', 'style'));
	Nimble::set_config('stylesheet_folder_url', '/public/style');
	Nimble::set_config('javascript_folder', FileUtils::join(dirname(__FILE__), '..', 'public', 'javascript'));
	Nimble::set_config('javascript_folder_url', '/public/javascript');
	Nimble::set_config('image_url', 'public/image');
	Nimble::set_config('image_path', FileUtils::join(dirname(__FILE__), '..', 'public', 'image'));
	Nimble::set_config('uri', '/');

	//define the root 
	define('NIMBLE_ROOT', FileUtils::join(dirname(__FILE__), '..'));
	
	// load any custom global config options 		
	require_once(FileUtils::join(dirname(__FILE__), 'config.php'));
	require_once(FileUtils::join(dirname(__FILE__), 'routes.php'));
	require_once(FileUtils::join(dirname(__FILE__), 'r404.php'));
	// load any custom enviroment config options
	// Nimble::Log('loading ' . NIMBLE_ENV . ' enviroment');
	require_once(FileUtils::join(dirname(__FILE__), NIMBLE_ENV, 'config.php'));
	require_once(FileUtils::join(NIMBLE_ROOT, 'app', 'controller', 'application_controller.php'));
	
	/** load controlers and models */
	foreach(array('model', 'controller') as $dir) {
		__load_files(FileUtils::join(dirname(__FILE__), '..', 'app', $dir));
	}
	
	
	//load database connection
	$database_info = json_decode(file_get_contents(FileUtils::join(NIMBLE_ROOT, 'config', NIMBLE_ENV, 'database.json')), true);
	$database_info = $database_info[NIMBLE_ENV];
	NimbleRecord::establish_connection($database_info);
	
	/** boot the framework */
  if(!defined('CLI_RUNNER')) {
		Run();
	}
?>

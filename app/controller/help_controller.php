<?php
	
/**
	* @package controller
	*/
class HelpController extends \ApplicationController {

	public function before_filter() {
	  $this->set_default_side_bar();
		$this->markdown_dir = FileUtils::join(NIMBLE_ROOT, 'app', 'view', 'help', 'markdown');
		$this->files = static::get_markdown_files($this->markdown_dir);
	}
	
	public static function get_markdown_files($dir) {
		$out = array();
		if (is_dir($dir)) {
	    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file) {
	      if (preg_match('/\.markdown$/', $file)) {
	        $out[] = (string) $file;
	      }
	    }
	  }
	return $out;
	}


	public function show() {
		require_once(FileUtils::join(NIMBLE_ROOT, 'lib', 'markdown.php'));
		$filename = $_GET['name'] . '.markdown';
		$this->title = ucwords(Inflector::humanize($_GET['name'] . ' help'));
		Nimble::set_title($this->title);
		if(array_include($filename, array_map(function($f){return basename($f);}, $this->files))) {
			$this->file = file_get_contents(FileUtils::join($this->markdown_dir, $filename));
		}else{
			Nimble::flash('notice', 'No page found for ' . $_GET['name']);
			$this->redirect_to(url_for('HelpController', 'index'));
		}
	}
	
	public function index() {
		$this->set_default_side_bar();
		$this->title = 'Pearfarm Help';
		Nimble::set_title($this->title);
		sort($this->files);
	}
	
	public function about() {
		$this->set_default_side_bar();
		require_once(FileUtils::join(NIMBLE_ROOT, 'lib', 'markdown.php'));
		$template = FileUtils::join(NIMBLE_ROOT, 'app', 'view', 'help', 'about.markdown');
		$this->about = file_get_contents($template);
		$this->title = 'About Pearfarm';
		Nimble::set_title($this->title);
	}

	public function stats() {
		$this->title = 'Pearfarm Stats';
		Nimble::set_title($this->title);
	}
}
?>
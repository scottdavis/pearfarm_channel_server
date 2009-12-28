<?php
	
/**
	* @package controller
	*/
class HelpController extends \ApplicationController {

	public function befor_filter() {
		$this->markdown_dir = FileUtis::join(NIMBLE_ROOT. 'app', 'view', 'help', 'markdown');
	}
	
	public static function get_markdown_files($dir) {
		$out = array();
		if (is_dir($dir)) {
	    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file) {
	      if (preg_match('/\.markdown$/', $file)) {
	        $out[] = $file;
	      }
	    }
	  }
	return $out;
	}


	public function show() {
		$files = static::get_markdown_files($this->markdown_dir);
		$filename = $_GET['name'] . '.markdown';
		if(array_include($filename, $files)) {
			$this->file = file_get_contents(FileUtils::join($this->markdown_dir, $filename));
		}else{
			Nimble::flash('notice', 'No page found for ' . $_GET['name']);
			$this->redirect_to(url_for('HelpController', 'index'));
		}
	}
	
	public function index() {
		$this->files = static::get_markdown_files($this->markdown_dir);
		ksort($this->files);
	}

}
?>
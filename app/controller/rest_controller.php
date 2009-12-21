<?php
	
/**
	* @package controller
	*/
class RestController extends \ApplicationController {

	public function before_filter() {
		parent::before_filter();
		$this->layout = false;
	}


  public function categories() {
		$this->categories = Category::find('all');
	}
	
	public function category_info() {
		$this->category = Category::find_by_name($_GET['name']);
	}
	
	public function category_packages() {
		$this->category = Category::find_by_name($_GET['name']);
		$this->packages = $this->category->packages;
	}
	
	public function packagesinfo() {
		$this->category = Category::find_by_name($_GET['name']);
		$this->packages = $this->category->packages;
	}
	
	public function allmaintainers() {
		$this->packages = $this->user->packages;
	}
	
	public function maintainer_info() {
		$this->m = Maintainer::find_by_name($_GET['name']);
	}
	
	public function packages() {
		
	}
	
	public function package_info() {
		
	}
	
	public function package_maintainers() {
		
	}
	
	public function package_developers() {
		
	}
	
	public function all_releases() {
		
	}
	
	public function all_releases2() {
		
	}
	
	public function latest_release() {
		//This file does not exist when no release has been made yet.
	}
	
	public function stable_release() {
				//This file does not exist when no release has been made yet.
	}
	
	public function beta_release() {
				//This file does not exist when no release has been made yet.
	}
	
	public function alpha_release() {
				//This file does not exist when no release has been made yet.
	}
	
	public function devel_release() {
				//This file does not exist when no release has been made yet.
	}
	
	public function release_version() {
		
	}
	
	public function release_version2() {
		
	}
	
	public function release_package_info() {
		
	}
	
	public function release_dependencies() {
			/*
				This is the format to be serialized
				array(2) {
				  ["required"]=>
				  array(2) {
				    ["php"]=>
				    array(1) {
				      ["min"]=>
				      string(5) "5.2.3"
				    }
				    ["pearinstaller"]=>
				    array(1) {
				      ["min"]=>
				      string(7) "1.7.1"
				    }
				  }
				  ["optional"]=>
				  array(1) {
				    ["package"]=>
				    array(2) {
				      ["name"]=>
				      string(4) "Toolbox"
				      ["channel"]=>
				      string(12) "pear.example.org"
				      ["min"] =>
				      string(7) "1.3.0"
				    }
				  }
				}
				*/

	}
}
?>
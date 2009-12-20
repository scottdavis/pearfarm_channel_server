<?php
	
/**
	* @package controller
	*/
class RestController extends \ApplicationController {

  public function categories() {

	}
	
	public function category_info() {
		
	}
	
	public function category_packages() {
		
	}
	
	public function packagesinfo() {
		
	}
	
	public function allmaintainers() {
		
	}
	
	public function maintainer_info() {
		
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
	
	public function latest_releases() {
		
	}
	
	public function stable_releases() {
		
	}
	
	public function beta_releases() {
		
	}
	
	public function alpha_releases() {
		
	}
	
	public function devel_releases() {
		
	}
	
	public function release_version() {
		
	}
	
	public function release_versions() {
		
	}
	
	public function release_package_info() {
		
	}
	
	public function release_dependencies() {
		if($this->format == 'txt') {
			$this->render('rest/release_dependencies.txt');
		}
	}
	
 
}
?>
<?php
/**
 * @package controller
 */
class RestController extends \ApplicationController {
  public function before_filter() {
    $this->filter();
    $this->layout = false;
  }
  public function categories() {
    $this->categories = collect(function ($p) {
      return $p->category;
    }, $this->user->packages);
  }
  public function category_info() {
    $this->category = Category::find_by_name($_GET['name']);
  }
  public function category_packages() {
    $this->category = Category::find_by_name($_GET['name']);
    $this->packages = Package::find('all', array('conditions' => array('category_id' => $this->category->id, 'user_id' => $this->user->id)));
		$date = DateHelper::from_db($this->packages->first()->updated_at);
		$date = date(DATE_RFC822, $date);
		$this->header("Last-Modified: $date");
  }
  public function packagesinfo() {
    $this->category = Category::find_by_name($_GET['name']);
    $this->packages = Package::find('all', array('conditions' => array('category_id' => $this->category->id, 'user_id' => $this->user->id)));
		$date = DateHelper::from_db($this->packages->first()->updated_at);
		$date = date(DATE_RFC822, $date);
		$this->header("Last-Modified: $date");
  }
  public function allmaintainers() {
    $this->packages = $this->user->packages;
		$date = DateHelper::from_db($this->packages->first()->updated_at);
		$date = date(DATE_RFC822, $date);
		$this->header("Last-Modified: $date");
  }
  public function maintainer_info() {
    $this->m = Maintainer::find_by_name($_GET['name']);
  }
  public function packages() {
    $this->packages = $this->user->packages;
		$date = DateHelper::from_db($this->packages->first()->updated_at);
		$date = date(DATE_RFC822, $date);
		$this->header("Last-Modified: $date");
  }
  public function package_info() {
    $this->package = Package::find('first', array('conditions' => array('name' => $_GET['name'], 'user_id' => $this->user->id)));
    $this->data = unserialize(Version::find('first', array('conditions' => array('package_id' => $this->package->id)))->meta);
  }
  public function package_maintainers() {
    $this->package = Package::find_by_name($_GET['name']);
		$date = DateHelper::from_db($this->package->updated_at);
		$date = date(DATE_RFC822, $date);
		$this->header("Last-Modified: $date");
    $data = unserialize(Version::find('first', array('conditions' => array('package_id' => $this->package->id)))->meta);
    $this->maintainers = array();
    foreach(array('lead', 'developer', 'contributor', 'helper') as $role) {
      if (isset($data[$role]) && !empty($data[$role])) {
        if (!is_assoc($data[$role])) {
          foreach($data[$role] as $node) {
            $node['role'] = $role;
            $this->maintainers[] = $node;
          }
        } else {
          $data[$role]['role'] = $role;
          $this->maintainers[] = $data[$role];
        }
      }
    }
  }
  public function package_maintainers2() {
    $this->package_maintainers();
  }
  public function all_releases() {
    $this->package = Package::find('first', array('conditions' => array('name' => $_GET['name'], 'user_id' => $this->user->id)));
    $this->versions = $this->package->versions;
		$date = DateHelper::from_db($this->package->updated_at);
		$date = date(DATE_RFC822, $date);
		$this->header("Last-Modified: $date");
  }
  public function all_releases2() {
    $this->all_releases();
  }
  public function latest_release() {
    try {
			$this->package = Package::find('first', array('conditions' => array('name' => $_GET['name'], 'user_id' => $this->user->id)));
      $version = $this->package->current_version();
			$date = DateHelper::from_db($this->package->updated_at);
			$date = date(DATE_RFC822, $date);
			$this->header("Last-Modified: $date");
      echo $version->version;
      $this->has_rendered = true;
    }
    catch(NimbleRecordException $e) {
      $this->header("HTTP/1.0 404 Not Found", 404);
    }
    //This file does not exist when no release has been made yet.
    
  }
  public function stable_release() {
    $type = VersionType::find_by_name('stable');
    $this->static_version_file($type);
    //This file does not exist when no release has been made yet.
    
  }
  public function beta_release() {
    $type = VersionType::find_by_name('beta');
    $this->static_version_file($type);
    //This file does not exist when no release has been made yet.
    
  }
  public function alpha_release() {
    $type = VersionType::find_by_name('alpha');
    $this->static_version_file($type);
    //This file does not exist when no release has been made yet.
    
  }
  public function devel_release() {
    $type = VersionType::find_by_name('devel');
    $this->static_version_file($type);
    //This file does not exist when no release has been made yet.
    
  }
  public function release_version() {
    $this->load_release();
  }
  public function release_version2() {
    $this->load_release();
  }
  public function release_package_info() {
		$this->load_release();
		echo $this->version->raw_xml;
		$this->has_rendered = true;
  }

  public function release_dependencies() {
    $this->load_release();
  }
  private function static_version_file($type) {
    try {
      $package = Package::find('first', array('name' => array($_GET['name'], 'user_id' => $this->user->id)));
      $version = Version::find('first', array('conditions' => array('version_type_id' => $type->id, 'package_id' => $package->id), 'order' => 'version DESC'));
			$date = DateHelper::from_db($package->updated_at);
			$date = date(DATE_RFC822, $date);
			$this->header("Last-Modified: $date");
      echo $version->version;
    }
    catch(NimbleRecordNotFound $e) {
      $this->header("HTTP/1.0 404 Not Found", 404);
    }
    $this->has_rendered = true;
  }
  private function load_release() {
    $this->package = Package::find('first', array('conditions' => array('name' => $_GET['name'], 'user_id' => $this->user->id)));
		$date = DateHelper::from_db($this->package->updated_at);
		$date = date(DATE_RFC822, $date);
		$this->header("Last-Modified: $date");
    $this->version = Version::find('first', array('conditions' => array('version' => $_GET['version'], 'package_id' => $this->package->id)));
    $this->data = unserialize($this->version->meta);
  }
}

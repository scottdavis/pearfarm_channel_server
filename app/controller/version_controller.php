<?php
/**
 * @package controller
 */
class VersionController extends \ApplicationController {
  
	public function before_filter() {
		$this->set_default_side_bar();
	}

  public function show() {
		if($this->is_logged_in()) {
			$this->login_user();
		}
    try {
			$user = User::find_by_username($_GET['username']);
      $this->package = Package::find('first', array('conditions' => array('user_id' => $user->id, 'name' => $_GET['package_name'])));
      $this->version = Version::find('first', array('conditions' => array('package_id' => $this->package->id, 'version' => $_GET['version'])));
			$this->title = $this->package->name . ' ' . $this->version->version;
			Nimble::set_title($this->title);
      $this->data = unserialize($this->version->meta);
    }
    catch(NimbleRecordNotFound $e) {
      Nimble::flash('notice', 'Version does not exist');
      $this->redirect_to('/');
    }
  }
  
  public function delete() {
    $this->login_user();
		try {
			$package = Package::find($_GET['id']);
      $version = Version::find($_GET['version']);  
		}catch(NimbleRecordNotFound $e) {
      	$this->redirect_to('/');
		}

			if($version->package_id == $package->id && $package->user_id == $this->user->id) {
      	$file = $package->file_path($version->version);
      	@unlink($file);
      	Nimble::flash('notice', "Version: {$version->version} was deleted");
      	$version->delete();
      	$this->redirect_to(url_for('PackageController', 'show', $package->user->username, $package->name));
			}else{
      	$this->redirect_to('/');
    	}
  }
  
  
  
  
  
}
?>
<?php
/**
 * @package controller
 */
class VersionController extends \ApplicationController {
  
  public function show() {
    try {
      $this->package = Package::find($_GET['id']);
      $this->version = Version::find('first', array('conditions' => array('package_id' => $this->package->id, 'version' => $_GET['version'])));
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
      $version = Version::find('first', array('select' => 'versions.*', 
                                              'joins' => 'INNER JOIN packages ON packages.id=versions.id INNER JOIN users ON users.id=packages.user_id', 
                                              'conditions' => array('versions.id' => $_GET['id'], 'users.id' => $this->user->id)
                                              )
                               );                    
      $package = $version->package;
      $file = $package->file_path($version->version);
      @unlink($file);
      Nimble::flash('notice', "Version: {$version->version} was deleted");
      Version::delete($version->id);
      $this->redirect_to(url_for('PackageController', 'show', $package->id));
    }catch(NimbleRecordNotFound $e) {
      $this->redirect_to('/');
    }
  }
  
  
  
  
  
}
?>
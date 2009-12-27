<?php
/**
 * @package controller
 */
class PackageController extends \ApplicationController {
  
  public function show() {
    try{
      $this->package = Package::find($_GET['id']);
      $this->versions = $this->package->versions;
      $this->version =  $this->package->current_version();
      $this->data = unserialize($this->version->meta);
    }catch(NimbleRecordNotFound $e) {
      Nimble::flash('notice', 'The package you were looking for does not exsist');
      $this->redirect_to('/');
    }
  }
  
  public function delete() {
    $this->login_user();
    try {
      $package = Package::find('first', array('conditions' => array('id' => $_GET['id'], 'user_id' => $this->user->id)));
      $package->clear_all_version();
      Nimble::flash('notice', $package->name . " was deleted");
      $package->destroy();
      $this->redirect_to('/');
    }catch(NimbleRecordNotFound $e) {
      Nimble::flash('notice', "Package does not exist or does not belong to you");
     $this->redirect_to('/'); 
    }
  }
  
  
}
?>
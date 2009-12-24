<?php
/**
 * @package controller
 */
class VersionController extends \ApplicationController {
  public function show($name, $id) {
    try {
      $this->package = Package::find('first', array('conditions' => array('name' => $_GET['name'])));
      $this->version = Version::find('first', array('conditions' => array('package_id' => $this->package->id, 'version' => $_GET['version'])));
      $this->data = unserialize($this->version->meta);
    }
    catch(NimbleRecordNotFound $e) {
      Nimble::flash('notice', 'Version does not exist');
      $this->redirect_to('/');
    }
  }
}
?>
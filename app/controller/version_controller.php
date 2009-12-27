<?php
/**
 * @package controller
 */
class VersionController extends \ApplicationController {
  public function show($name, $id) {
    try {
      $this->package = Package::find($_GET['id']);
      $max = $this->package->max('versions', 'version');
      if($_GET['version'] == (string) $max) {
        $this->redirect_to(url_for('PackageController', 'show', $this->package->id));
      }
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
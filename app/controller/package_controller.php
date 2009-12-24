<?php
/**
 * @package controller
 */
class PackageController extends \ApplicationController {
  public function before_filter() {
    $this->login_user();
  }
  public function show($id) {
    $this->package = Package::find('first', array('conditions' => array('name' => $_GET['name'], 'user_id' => $this->user->id)));
    $this->versions = $this->package->versions;
  }
}
?>
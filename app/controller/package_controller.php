<?php
/**
 * @package controller
 */
class PackageController extends \ApplicationController {
  public function show($id) {
    $this->package = Package::find('first', array('conditions' => array('name' => $_GET['name'])));
    $this->versions = $this->package->versions;
  }
}
?>
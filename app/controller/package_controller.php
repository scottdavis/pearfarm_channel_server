<?php
/**
 * @package controller
 */
class PackageController extends \ApplicationController {
  public function show() {
    try{
      $this->package = Package::find($_GET['id']);
      $this->versions = $this->package->versions;
    }catch(NimbleRecordNotFound $e) {
      Nimble::flash('notice', 'The package you were looking for does not exsist');
      $this->redirect_to('/');
    }
  }
}
?>
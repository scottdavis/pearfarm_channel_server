<?php
/**
 * @package controller
 */
class LandingController extends \ApplicationController {
  public function index() {
    if (!$this->is_logged_in()) {
			$this->latest = Package::find('all', array('limit' => '0,5', 'order' => 'created_at DESC'));
			$this->updated = Package::find('all', array('limit' => '0,5', 'order' => 'updated_at DESC'));
			
    } else {
      $this->login_user();
      $this->packages = $this->user->packages;
      $this->header('Content-Type: text/html', 200);
      $this->render('channel/index.php');
    }
  }
}

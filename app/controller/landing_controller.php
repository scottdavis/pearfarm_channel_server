<?php
/**
 * @package controller
 */
class LandingController extends \ApplicationController {
  public function index() {
		if(!$this->is_logged_in()) {
    	$this->packages = Package::find('all');
		}else{
			$this->login_user();
			$this->packages = $this->user->packages;
      $this->header('Content-Type: text/html', 200);
			$this->render('channel/index.php');
		}
  }
}

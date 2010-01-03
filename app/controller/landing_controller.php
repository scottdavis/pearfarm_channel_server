<?php
/**
 * @package controller
 */
class LandingController extends \ApplicationController {
  public function index() {
		$this->title = 'Making it trivially easy to create PEAR packages.';
		$this->set_default_side_bar();
		if($this->is_logged_in()) {
			$this->login_user();
		}
  }
  
  
  public function user_index() {
    try{
      $this->user = User::find('first', array('conditions' => array('username' => $_GET['name'], 'active' => 1)));
      $this->packages = $this->user->packages;
    }catch(NimbleRecordnotFound $e) {
      $this->redirect_to('/');
    }
  }
  
  
}

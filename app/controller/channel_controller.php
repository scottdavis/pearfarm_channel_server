<?php
/**
 * @package controller
 */
class ChannelController extends \ApplicationController {
  public function before_filter() {
		switch($this->format) {
			case 'xml':
				$this->filter();
			break;
			default:
    		$this->login_user();
			break;
		}
		$this->ran_filter = true;
  }
  /**
   * index
   */
  public function index() {
    switch ($this->format) {
      case 'xml':
				if($this->user->active == 0) {exit();}
        $this->layout = false;
        $this->render('channel/index.xml');
        $this->header('Content-Type: text/xml', 200);
      break;
      default:
        $this->packages = $this->user->packages;
        $this->header('Content-Type: text/html', 200);
      break;
    }
  }
  public function add() {
    $_SESSION['upload_key'] = $this->key = md5(time() . rand(0, 100));
  }
  /**
   * This handles uploads to a persions channel
   * Need file posted as 'file' and the has poster as 'hash'
   */
  public function upload() {
    switch ($this->format) {
      case 'xml':
        try {
          $package = Package::from_upload(array('file' => $_FILES['file']['tmp_name'], 'sig' => $_POST['signatureBase64'], 'user' => $this->user), true);
          if($package->saved) {
            echo 'Package uploaded succesfuly!';
          }
        }
        catch(Exception $e) {
          $this->header("HTTP/1.0 500 Internal Server Error", 500);
          echo $e->getMessage();
        }
        $this->has_rendered = true;
      break;
      default:
        if ($_SESSION['upload_key'] !== $_POST['upload_key']) {
          Nimble::flash('notice', 'Invalid Upload Key');
          $this->redirect_to(url_for('LandingController', 'user_index', $this->user->username));
        }
        unset($_SESSION['upload_key']);
        try {
          $package = Package::from_upload(array('file' => $_FILES['file']['tmp_name'], 'user' => $this->user));
					 if ($package->saved) {
		          $this->redirect_to(url_for('LandingController', 'user_index', $this->user->username));
		        }
        }
        catch(Exception $e) {
          Nimble::flash('notice', $e->getMessage());
          $this->redirect_to(url_for('ChannelController', 'upload'));
        }
      break;
    }
  }
}

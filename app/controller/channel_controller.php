<?php
/**
 * @package controller
 */
class ChannelController extends \ApplicationController {
	
	public function before_filter() {
		if($this->format == 'xml') {
			$this->filter();
		}else{
			$this->login_user();
		}
		
	}
	
  /**
   * index
   */
  public function index() {
    switch($this->format) {
			case 'xml':
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
		$_SESSION['upload_key'] = $this->key = md5(time(). rand(0,100));
	}

  /**
    * This handles uploads to a persions channel
    * Need file posted as 'file' and the has poster as 'hash'
    */
  public function upload() {
		switch($this->format) {
			case 'xml':
				$p = Package::from_upload(array('file' => $_FILES['file']['tmp_name'], 'hash' => $_POST['hash'], 'user' => $this->user));
	    	echo ($package->saved) ? 'true' : 'false';
	    	$this->has_rendered = true;
			break;
			default:
			var_dump($_FILES);
				if($_SESSION['upload_key'] !== $_POST['upload_key']) {
					Nimble::flash('notice', 'Invalid Upload Key');
					$this->redirect_to(url_for('ChannelController', 'index'));
				}
				unset($_SESSION['upload_key']);
				$p = Package::from_upload(array('file' => $_FILES['file']['tmp_name'], 'user' => $this->user));
				if($p->saved) {
					$this->redirect_to(url_for('ChannelController', 'index'));
				}else{
					var_dump($p);
					$_SESSION['upload_key'] = $this->key = md5(time(). rand(0,100));
					$this->render('channel/add.php');
				}
			break;
		}
    
  }
  
  
  public function add_package() {
    
  }
  
}

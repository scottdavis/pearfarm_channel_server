<?php
/**
 * @package controller
 */
class PackageController extends \ApplicationController {
  

	public function index() {
		$this->set_default_side_bar();
		$page = isset($_GET['page']) ? $_GET['page'] : NULL;
		$this->packages = Package::paginate(array('order' => 'name DESC', 'per_page' => 20, 'page' => $page));
		
		
		switch($this->format) {
			case 'xml':
			  $this->header('Content-Type: text/xml', 200);
				echo $this->packages->to_xml(array('include' => array('versions')));
				$this->layout = false;
				$this->has_rendered = true;
			break;
			case 'atom':
			
			break;
			case 'rss':
			
			break;
		}
		
	}

  public function show() {
		if($this->is_logged_in()) {
			$this->login_user();
		}
    try{
			$this->set_default_side_bar();
      $this->package = Package::find($_GET['id']);
      $this->versions = $this->package->versions;
      $this->version =  $this->package->current_version();
      if($this->version !== false) {
        $this->data = unserialize($this->version->meta);
      }
    }catch(NimbleRecordNotFound $e) {
      Nimble::flash('notice', 'The package you were looking for does not exsist');
      $this->redirect_to('/');
    }
  }
  
  public function delete() {
    $this->login_user();
    try {
      $package = Package::find('first', array('conditions' => array('id' => $_GET['id'], 'user_id' => $this->user->id)));
      $package->clear_all_version();
      Nimble::flash('notice', $package->name . " was deleted");
      $package->destroy();
      $this->redirect_to('/');
    }catch(NimbleRecordNotFound $e) {
      Nimble::flash('notice', "Package does not exist or does not belong to you");
     $this->redirect_to('/'); 
    }
  }
  
  
}
?>
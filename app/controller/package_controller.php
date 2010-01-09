<?php
/**
 * @package controller
 */
class PackageController extends \ApplicationController {
  

	public function index() {
		$this->set_default_side_bar();
		$this->title = 'All Packages';
		Nimble::set_title($this->title);
		$page = isset($_GET['page']) ? $_GET['page'] : NULL;
		
		switch($this->format) {
			case 'xml':
 				$this->packages = Package::find_all();
			  $this->header('Content-Type: text/xml', 200);
				echo $this->packages->to_xml();
				$this->layout = false;
				$this->has_rendered = true;
			break;
			case 'json':
			 	$this->packages = Package::find_all();
				$this->header('Content-type: application/json', 200);
				echo $this->packages->to_json();
				$this->layout = false;
				$this->has_rendered = true;
			break;
			case 'atom':
			
			break;
			case 'rss':
			
			break;
			default:
					$this->packages = Package::paginate(array('order' => 'name DESC', 'per_page' => 20, 'page' => $page));
			break;
		}
		
	}

  public function show() {
	$user = User::find_by_username($_GET['username']);
	switch($this->format) {
		case 'xml':
			$this->header('Content-Type: text/xml', 200);
			$this->package = Package::find('first', array('conditions' => array('user_id' => $user->id, 'name' => $_GET['package_name'])));
			echo $this->package->to_xml();
			$this->layout = false;
			$this->has_rendered = true;
		break;
		case 'json':
			$this->header('Content-type: application/json', 200);
			$this->package = Package::find('first', array('conditions' => array('user_id' => $user->id, 'name' => $_GET['package_name'])));
			echo $this->package->to_json();
			$this->layout = false;
			$this->has_rendered = true;
		break;
		default:
			if($this->is_logged_in()) {
				$this->login_user();
			}
	    try{
				$this->set_default_side_bar();
	      $this->package = Package::find('first', array('conditions' => array('user_id' => $user->id, 'name' => $_GET['package_name'])));
				$this->title = $this->package->name;
				Nimble::Set_title($this->title);
	      $this->versions = Version::find_all(array('limit' => '0,5', 'conditions' => array('package_id' => $this->package->id), 'order' => 'version DESC'));
				$this->total_versions = $this->package->count('versions');
	      $this->version =  $this->package->current_version();
	      if($this->version !== false) {
	        $this->data = unserialize($this->version->meta);
	      }
	    }catch(NimbleRecordNotFound $e) {
	      Nimble::flash('notice', 'The package you were looking for does not exsist');
	      $this->redirect_to('/');
	    }
		break;
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

	public function edit_website() {
		$this->layout = false;
		$this->has_rendered = true;
		$package = Package::find('first', array('conditions' => array('id' => $_GET['package_id'], 'user_id' => $this->user->id)));
		if($_POST['editorId'] == 'website') {
			$p = Package::update($package->id, array('url' => $_POST['value']));
			if($p->saved) {
				echo $p->url;
			}else{
				echo $package->url;
			}
		}

	}
  
  
}
?>
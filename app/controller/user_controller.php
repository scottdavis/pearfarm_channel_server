<?php
	
	/**
		* @package controller
		*/
class UserController extends \ApplicationController {
   
  public function before_filter_except_show() {
    $this->login_user();
  }

	public function show() {
		
		$only = array('username');
		$user = User::find($_GET['id']);
		switch($this->format) {
			case 'json':
				$this->header('Content-type: application/json', 200);
				$this->layout = false;
				$this->has_rendered = true;
				echo $user->to_json();
			break;
			case 'xml':
			 	$this->header('Content-Type: text/xml', 200);
				echo $user->to_xml();
				$this->layout = false;
				$this->has_rendered = true;
			break;
			default:
				$this->redirect_to(url_for('LandingController', 'user_index', $user->username));
			break;
		}
		
	}
   
  public function edit() {
		$this->set_default_side_bar();
    $this->keys = $this->user->pkis;
	}

	public function update() {
	  if(isset($_POST['user']['password']) && empty($_POST['user']['password'])) {
	    unset($_POST['user']['password']);
	  }
	  if(!isset($_POST['v_password'])) {
	    unset($_POST['user']['password']);
	  }
	  if(isset($_POST['user']['password']) && isset($_POST['v_password'])) {
	    if($_POST['user']['password'] != $_POST['v_password']) {
	      unset($_POST['user']['password']);
	    }
	  }
	  $this->user = User::update($this->user->id, $_POST['user']);
	  if($this->user->saved) {
	    Nimble::flash('notice', 'User information as been updated');
	    $this->redirect_to(LoginController::user_url($this->user));
	  }else{
	    $this->edit();
	    $this->render('user/edit.php');
	  }
	}
  

	public function edit_key() {
		$this->layout = false;
		try{
			$this->key = Pki::find('first', array('conditions' => array('id' => $_GET['id'], 'user_id' => $this->user->id)));
		}catch(NimbleRecordNotFound $e) {
			return false;
			$this->has_rendered = true;
		}
	}

	public function add_key() {
		$this->layout = false;
		$this->key = new Pki;
	}

 public function create_key() {
	$this->header('Content-Type: application/javascript', 200);
	$this->key = new Pki(array_merge($_POST['pki'], array('user_id' => $this->user->id)));
    if($this->key->save()) {
     echo "facebox.close();window.location.href=window.location.href;";
   }else{
     $return = escape_javascript($this->render_partial('user/add_key.php'));
		echo "$('pki').replace('$return');";
   }
    $this->has_rendered = true;
  }
  
  public function update_key() {
	$this->header('Content-Type: application/javascript', 200);
	$this->layout = false;
   $this->key = Pki::update($_GET['id'], $_POST['pki']);
   if($this->key->save()) {
     echo "facebox.close();window.location.href=window.location.href;";
   }else{
		$this->key->id = $_GET['id'];
		$return = escape_javascript($this->render_partial('user/edit_key.php'));
		echo "$('pki').replace('$return');";
   }
  	$this->has_rendered = true;
  }
  
  public function delete_key() {
    if(Pki::exists(array('id' => $_GET['id'], 'user_id' => $this->user->id))) {
      Pki::delete($_GET['id']);
      $this->redirect_to(url_for('UserController', 'edit'));
    }else{
		 $this->redirect_to(url_for('UserController', 'edit'));
    }
    $this->has_rendered = true;
  }
   
  public function delete() {
    foreach($this->user->packages as $package) {
      $package->clear_all_versions();
      $package->destroy();
    }
    User::delete($this->user->id);
    unset($_SESSION['user']);
    session_destroy();
    Nimble::flash('notice', 'Your account as been deleted');
    $this->redirect_to("http://" . DOMAIN);
  } 
}
?>
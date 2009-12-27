<?php
	
	/**
		* @package controller
		*/
	class UserController extends \ApplicationController {
   
   public function before_filter() {
     $this->login_user();
   }
   
   public function edit() {
     $this->keys = $this->user->pkis;
   }
   
   public function update() {
     if(isset($_POST['user']['password']) && empty($_POST['user']['password'])) {
       unset($_POST['user']['password']);
     }
     $this->user = User::update($this->user->id, $_POST['user']);
     if($this->user->saved) {
       Nimble::flash('notice', 'User information as been updated');
       $this->redirect_to('/');
     }else{
       $this->edit();
       $this->render('user/edit.php');
     }
   }
   
  public function add_key() {
    $this->user->pkis = array($_POST['pki']);
    try {
      $this->user->save();
      echo 'true';
    }catch(NimbleRecordException $e) {
      echo 'false'; 
    }
     $this->has_rendered = true;
   }
   
   public function update_key() {
     $key = Pki::update($_GET['id'], $_POST['pki']);
     if($key->save()) {
       echo 'true';
     }else{
       echo 'false';
     }
     $this->has_rendered = true;
   }
   
   public function delete_key() {
     if(Pki::exists(array('id' => $_GET['id'], 'user_id' => $this->user->id))) {
       Pki::delete($_GET['id']);
       echo 'true';
     }else{
       echo 'false';
     }
     $this->has_rendered = true;
   }
   
   public function delete() {
     User::delete($this->user->id);
     unset($_SESSION['user']);
     session_destroy();
     $this->redirect_to("http://" . DOMAIN);
   }
   
  }
?>
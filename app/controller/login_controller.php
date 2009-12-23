<?php
	
	/**
		* @package controller
		*/
	class LoginController extends \ApplicationController {
	  
	  public function before_filter() {
			$this->redirect_if_logged_in();
		}
	
	  public function index() {
	    $this->render('login/form.php');
	  }
	  
    public function login() {
      if(User::authenticate($_POST['username'], $_POST['password'])) {
				$user = User::find_by_username($_POST['username']);
        $_SESSION['user'] = $user->id;
				$this->redirect_if_logged_in();
      }else{
        $this->render('login/form.php');
      }
    }
		private function redirect_if_logged_in() {
			if($this->is_logged_in()) {
				$user = User::find($_SESSION['user']);
				$url = static::user_url($user);
	      $this->redirect_to($url);
			}
		}
		
		public static function user_url($user) {
			return "http://$user->username." . DOMAIN . url_for('ChannelController', 'index');
		}


	}
?>
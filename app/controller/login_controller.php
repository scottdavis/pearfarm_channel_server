<?php
/**
 * @package controller
 */
class LoginController extends \ApplicationController {
  public function before_filter_except_logout() {
    $this->redirect_if_logged_in();
		$this->set_default_side_bar();
  }
  public function index() {
		$this->title = 'Login';
		Nimble::set_title($this->title);
    $this->render('login/form.php');
  }
  public function login() {
		$this->title = 'Login';
		Nimble::set_title($this->title);
    try{
      if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && User::authenticate($_POST['username'], $_POST['password'])) {
        $user = User::find_by_username($_POST['username']);
        $_SESSION['user'] = $user->id;
        $this->redirect_if_logged_in();
      } else {
        Nimble::flash('notice', 'Invalid Login Information');
        $this->render('login/form.php');
      }
    }catch(NimbleRecordNotFound $e) {
      Nimble::flash('notice', 'Invalid Login Information');
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
  public function logout() {
    unset($_SESSION['user']);
		// @codeCoverageIgnoreStart
    if(!defined('NIMBLE_IS_TESTING')) {
			session_destroy();
		}
    // @codeCoverageIgnoreEnd
    $url = "http://" . DOMAIN;
    $this->redirect_to($url);
  }
	public function add() {
		$this->user = new User();
	}
	public function create() {
		if(!empty($_POST['whoanow'])) {$this->header("HTTP/1.0 404 Not Found", 404);exit();} //this owns bots
		$this->user = new User($_POST['user']);
		if(!$this->user->save()) {
			$this->render('login/add.php');
		}else{
			Nimble::flash('notice', "Thank you for registering please check your email to verify your account");
			$this->redirect_to('/');
		}
		if($this->user->password != $_POST['v_password']) {
			$this->user->errors['password'] = "Password does not match";
		}

	}
	public function verify() {
		try {
			$user = User::find_by_api_key($_GET['key']);
			$user->active = 1;
			if($user->save()) {
				Nimble::flash('notice', 'Account has been activated please login');
				$this->redirect_to(url_for('LoginController', 'login'));
			}
		}catch(NimbleRecordNotFound $e) {
			Nimble::flash('notice', 'Invaild activation key');
			$this->redirect_to('/');
		}
	}
	
	public function check_user() {
		echo User::exists('username', $_POST['username']) ? 'true' : 'false';
		$this->layout = false;
		$this->has_rendered = true;
	}


  public static function user_url($user) {
    return "http://" . DOMAIN . '/' . $user->username;
  }
}
?>
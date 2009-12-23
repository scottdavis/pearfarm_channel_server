<?php
/**
 * @package controller
 */
class LoginController extends \ApplicationController {
  public function before_filter_except_logout() {
    $this->redirect_if_logged_in();
  }
  public function index() {
    $this->render('login/form.php');
  }
  public function login() {
    if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && User::authenticate($_POST['username'], $_POST['password'])) {
      $user = User::find_by_username($_POST['username']);
      $_SESSION['user'] = $user->id;
      $this->redirect_if_logged_in();
    } else {
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
		session_destroy();
		$url = "http://" . DOMAIN;
		$this->redirect_to($url);
	}



  public static function user_url($user) {
    return "http://$user->username." . DOMAIN . url_for('ChannelController', 'index');
  }
}
?>
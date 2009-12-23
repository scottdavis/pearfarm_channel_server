<?php
/**
 * @package controller
 */
class ApplicationController extends \Controller {
  public function filter() {
    $this->subdomain = $this->get_sub_domain();
    $this->user = User::find_by_username($this->subdomain);
    $this->header('Content-Type: text/xml');
  }
  public function get_sub_domain() {
    $array = explode('.', $_SERVER['SERVER_NAME']);
    return reset($array);
  }
  public function is_logged_in() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']);
  }
  public function login_user() {
    if ($this->is_logged_in()) {
      $this->user = User::find($_SESSION['user']);
      if ($this->get_sub_domain() !== $this->user->username) {
        $this->redirect_to(LoginController::user_url($this->user));
      }
    } else {
      $this->redirect_to(url_for('LoginController', 'index'));
    }
  }
}

<?php
/**
 * @package controller
 */
class ApplicationController extends \Controller {
  
	public function __construct() {
		$this->header("Content-Type: text/html; charset=utf-8");
		$this->total_packages = Package::count();
		$this->sidebar = array();
		$this->title = '';
	}

	public function filter() {
    $this->user = User::find_by_username($this->get_sub_domain());
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


	public function show_flash() {
		if(isset($_SESSION['flashes']['notice']) && !empty($_SESSION['flashes']['notice'])) {
			$notice = Nimble::display_flash('notice');
			echo "<div id='flash' class='notice'>$notice</div>";
		}
	}



	public function set_default_side_bar() {
		$this->latest = Package::find('all', array('limit' => '0,5', 'order' => 'created_at DESC'));
		$this->sidepackage = $this->latest;
		$this->sidebar[0]['title'] = "New Packages";
		$this->sidebar[0]['content'] = $this->render_partial('layout/_package_list.php');
		$this->updated = Package::find('all', array('limit' => '0,5', 'order' => 'updated_at DESC'));
		$this->sidepackage = $this->updated;
		$this->sidebar[1]['title'] = "Recently Updated";
		$this->sidebar[1]['content'] = $this->render_partial('layout/_package_list.php');
	}

}

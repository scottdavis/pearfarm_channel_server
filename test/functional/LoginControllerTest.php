<?php
/**	
 * @package functional_test
 */
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class LoginControllerTest extends NimbleFunctionalTestCase {
  public function setUp() {
    $this->user = User::find_by_username('bob');
    $_SERVER['SERVER_NAME'] = 'bob.localhost';
  }
  public function testLoginUser() {
    $this->post('login', array(), array('username' => 'bob', 'password' => 'password'), array());
    $this->assertRedirect("http://{$this->user->username}." . DOMAIN);
    $this->assertEquals($_SESSION['user'], $this->user->id);
  }
  public function testLoginFails() {
    $this->post('login', array(), array('username' => 'bob', 'password' => 'foo'), array(), 'html');
    $this->assertTemplate('form');
    $this->assertFalse(isset($_SESION['user']));
  }
  public function testVerify() {
    $user = User::find_by_username('jim');
    $this->get('verify', array(), array('key' => $user->api_key), array());
    $user2 = User::_find($user->id);
    $this->assertEquals(1, $user2->active);
    $this->assertRedirect(url_for('LoginController', 'login'));
  }
  public function testVerifyFails() {
    $this->get('verify', array(), array('key' => '098265082652jlkgkjsg'), array());
    $this->assertRedirect('/');
  }
	public function testCheckUser() {
		$this->post('check_user', array(), array('username' => 'poopy'));
		$this->responseIncludes('false');
	}
	public function testCheckUserFails() {
		$this->post('check_user', array(), array('username' => 'bob'));
		$this->responseIncludes('true');
	}
	public function testGetIndex() {
		$this->get('index');
		$this->assertTemplate('form');
	}
	
	public function testCreate() {
		$c = User::count();
		$this->post('create', array(), array('whoanow' => '', 'v_password' => 'password', 'user' => array('username' => 'poopy', 'email' => 'jetviper21@gmail.com', 'password' => 'password')));
		$this->assertRedirect('/');
		$this->assertEquals($c +1, User::count(array('cache' => false)));
		$user = $this->assigns('user');
		$this->assertTrue($user->saved);
	}
	
	public function testCreateFails() {
		$c = User::count();
		$this->post('create', array(), array('whoanow' => '', 'v_password' => 'password', 'user' => array('username' => 'poopy', 'email' => '', 'password' => 'password')));
		$this->assertEquals($c, User::count(array('cache' => false)));
		$this->assertTemplate('add');
	}
	
	public function testLogout() {
		$this->get('logout', array(), array(), array('user' => User::find_by_username('bob')));
		$this->assertFalse(isset($_SESSION['user']));
		$this->assertRedirect('http://' . DOMAIN);
	}
	
	public function testAdd() {
		$this->get('add');
		$this->assertTemplate('add');
		$this->assertTrue(isset($this->controller->user));
	}
	
}
?>
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

}
?>
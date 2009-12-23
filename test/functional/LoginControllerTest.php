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
    $this->assertRedirect('http://bob.localhost/channel');
    $this->assertEquals($_SESSION['user'], $this->user->id);
  }
  public function testLoginFails() {
    $this->post('login', array(), array('username' => 'bob', 'password' => 'foo'), array(), 'html');
    $this->assertTemplate('form');
    $this->assertFalse(isset($_SESION['user']));
  }
}
?>
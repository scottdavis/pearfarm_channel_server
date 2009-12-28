<?php
/**	
 * @package functional_test
 */
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class LandingControllerTest extends NimbleFunctionalTestCase {
  public function testGetsIndex() {
    $this->get('index');
    $this->assertTemplate('index');
  }
  public function testGetsIndexLoggedin() {
    $_SERVER['SERVER_NAME'] = 'bob.localhost.com';
    $this->get('index', array(), array(), array('user' => User::find_by_username('bob')->id));
    $this->assertTemplate('channel/index.php');
  }
  public function testPublicUserProfile() {
    $this->get('user_index', array(), array('name' => 'bob'));
    $this->assertTemplate('user_index');
    $user = $this->assigns('user');
    $this->assertEquals($user->username, 'bob');
  }
}
?>
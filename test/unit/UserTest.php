<?php
/**
 * @package unit_test
 */
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class UserUnitTest extends NimbleUnitTestCase {
	
	public function setUp() {
		NimbleRecord::start_transaction();
	}
	
	public function tearDown() {
		NimbleRecord::rollback_transaction();
	}
	
  public function testMakesApiKey() {
		$user = User::create(array('username' => 'bobby', 'email' => 'foo@mail.com', 'password' => 'foo'));
		$api = $user->api_key;
		$user->active = 1;
		$user->save();
		$user2 = User::find_by_username('bobby');
		$this->assertEquals($api, $user2->api_key);
  }
}
?>
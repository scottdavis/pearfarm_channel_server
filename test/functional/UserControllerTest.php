<?php
	/**	
		* @package functional_test	
		*/
	require_once('nimblize/nimble_test/lib/phpunit_testcase.php');
  class UserControllerTest extends NimbleFunctionalTestCase {
		
		public function setUp() {
      $_SERVER['SERVER_NAME'] = 'bob.localhost';
      $this->user = User::find_by_username('bob');
		}
		
		public function testUserUpdateEmail() {
		  $this->put('update', array(), array('id' => $this->user->id, 'user' => array('email' => 'my_new_email@email')), array('user' => $this->user->id));
		  $user = User::_find($this->user->id);
		  $this->assertEquals($this->user->password, $user->password);
		  $this->assertEquals('my_new_email@email', $user->email);
		  $this->assertRedirect('/');;
		}
		
		
	}
?>
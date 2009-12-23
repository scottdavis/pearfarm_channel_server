<?php
/**	
 * @package functional_test
 */
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class ChannelControllerTest extends NimbleFunctionalTestCase {
	
	public function setUp() {
		$_SERVER['SERVER_NAME'] = 'bob.localhost';
	}

  public function testGetsChannelXml() {
    $this->get('index', array(), array(), array(), 'xml');
    $this->assertTemplate('index.xml');
  }
  public function testGetsChannelHtml() {
    $this->get('index', array(), array(), array('user' => User::find_by_username('bob')->id));
    $this->assertTemplate('index');
  }
}
?>
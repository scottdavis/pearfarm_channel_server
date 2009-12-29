<?php
/**	
 * @package functional_test
 */
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class SearchControllerTest extends NimbleFunctionalTestCase {
  public function testSearch() {
		$_SERVER['REQUEST_URI'] = '/';
    $this->get('search', array(), array('search' => 'bob'));
    $this->assertTemplate('search');
    $packages = $this->assigns('packages');
    $this->assertEquals(count($packages), 1);
  }
  public function testSearchEmptyRedirects() {
    $this->get('search', array(), array('search' => ''));
    $this->assertRedirect('/');
  }
}
?>
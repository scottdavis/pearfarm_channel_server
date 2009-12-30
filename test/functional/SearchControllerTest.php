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

	public function testSearchJSON() {
		$_SERVER['REQUEST_URI'] = '/';
    $this->get('search', array(), array('search' => 'bob'), array(), 'json');
		$this->assertEquals($this->response, json_encode(array('bob', array('bobs_other_package'))));
	}
	
	public function testSearchXML() {
		$_SERVER['REQUEST_URI'] = '/';
    $this->get('search', array(), array('search' => 'bob'), array(), 'xml');
    $this->assertTemplate('search.xml');
    $packages = $this->assigns('packages');
		$this->assertEquals(count($packages), 1);
	}

	public function testOpensearch() {
		$_SERVER['REQUEST_URI'] = '/';
    $this->get('opensearch');
    $this->assertTemplate('opensearch');
	}

}
?>
<?php
/**	
 * @package functional_test
 */
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class PackageControllerTest extends NimbleFunctionalTestCase {
  public function testGetsBobspackage() {
		$p = Package::find_by_name('bobs_other_package');
    $this->get('show', array(), array('package_name' => $p->name, 'username' => User::find_by_username('bob')->username));
    $this->assertTemplate('show');
    $package = $this->assigns('package');
    $this->assertEquals($package->name, 'bobs_other_package');
  }
  public function testGetsPackageFails() {
    $this->get('show', array(), array('username' => '', 'package_name' => 'foo'));
    $this->assertRedirect('/');
  }
  public function testDeleteBobsPackage() {
    $_SERVER['SERVER_NAME'] = 'bob.localhost.com';
    $count = Package::count();
    $v_count = Version::count();
    $p = Package::find_by_name('bobs_other_package');
    $versions = $p->count('versions');
    $this->delete('delete', array(), array('id' => $p->id), array('user' => User::find_by_username('bob')->id));
    $this->assertEquals($count - 1, Package::count(array('cache' => false)));
    $this->assertEquals($v_count - $versions, Version::count(array('cache' => false)));
    $this->assertRedirect('/');
  }

	public function testGetIndex() {
		$_SERVER['REQUEST_URI'] = '/packages';
		$this->get('index');
		$this->assertTemplate('index');
	}
	
	public function testGetXML() {
		$_SERVER['REQUEST_URI'] = '/packages';
		$this->get('index', array(), array(), array(), 'xml');
		$this->assertResponse('success');
	}
	
	public function testGetRSS() {
		$_SERVER['REQUEST_URI'] = '/packages';
		$this->get('index', array(), array(), array(), 'rss');
		$this->assertResponse('success');
	}
	
	public function testGetATOM() {
		$_SERVER['REQUEST_URI'] = '/packages';
		$this->get('index', array(), array(), array(), 'atom');
		$this->assertResponse('success');
	}
	


}
?>
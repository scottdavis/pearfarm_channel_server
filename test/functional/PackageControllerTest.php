<?php
/**	
 * @package functional_test
 */
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class PackageControllerTest extends NimbleFunctionalTestCase {
  public function testGetsBobspackage() {
    $this->get('show', array(), array('id' => Package::find_by_name('bobs_other_package')->id));
    $this->assertTemplate('show');
    $package = $this->assigns('package');
    $this->assertEquals($package->name, 'bobs_other_package');
  }
  public function testGetsPackageFails() {
    $this->get('show', array(), array('id' => 'foo'));
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
}
?>
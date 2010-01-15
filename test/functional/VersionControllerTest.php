<?php
/**	
 * @package functional_test
 */
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class VersionControllerTest extends NimbleFunctionalTestCase {
  public function testGetVersion() {
    $p = Package::find_by_name('bobs_other_package');
		$u = $p->user;
    $last = $p->versions->last();
    $this->get('show', array(), array('username' => $u->username, 'package_name' => $p->name, 'version' => $last->version));
    $this->assertTemplate('show');
  }
  public function testDeleteBobsPackage() {
    $_SERVER['SERVER_NAME'] = 'bob.localhost.com';
    $count = Version::count();
    $p = Package::find_by_name('bobs_other_package');
		$v = Version::find('first', array('package_id' => $p->id, 'version' => '0.0.1'));
    $this->delete('delete', array(), array('id' => $v->package_id, 'version' => $v->id), array('user' => User::find_by_username('bob')->id));
    $this->assertEquals($count - 1, Version::count(array('cache' => false)));
		$this->assertFalse(Version::exists('id', $v->id));
    $this->assertRedirect(url_for('PackageController', 'show', $p->user->username, $p->name));
  }
}
?>
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
}
?>
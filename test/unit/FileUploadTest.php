<?php
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
require_once (NIMBLE_ROOT . '/lib/package_extractor.php');
class FileUploadTest extends PHPUnit_Framework_TestCase {
  public function testUploadFail() {
    $localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'nimblize-0.0.1.tgz');
    $user = User::find('first');
    $hash = md5(md5_file($localfile) . $user->api_key);
    try {
      $p = Package::from_upload(array('file' => $localfile, 'hash' => $hash, 'user' => $user));
    }
    catch(Exception $e) {
      $this->assertEquals('Package channel pear.nimblize.com does not match bob.localhost', $e->getMessage());
    }
  }
  public function testUpload() {
    $localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'bobs_other_package-0.0.1.tgz');
    $user = User::find_by_username('bob');
    $hash = md5(md5_file($localfile) . $user->api_key);
    $p = Package::from_upload(array('file' => $localfile, 'hash' => $hash, 'user' => $user));
    $this->assertTrue(file_exists($p->file_path('0.0.1')));
  }
}
?>
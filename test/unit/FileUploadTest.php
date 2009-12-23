<?php
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
require_once (NIMBLE_ROOT . '/lib/package_extractor.php');
class FileUploadTest extends PHPUnit_Framework_TestCase {
  
  public function testUpload() {
    $localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'PHPUnit-3.4.5.tar');
    $user = User::find('first');
    $hash = md5(md5_file($localfile) . $user->api_key);
    $p = Package::from_upload(array('file' => $localfile, 'hash' => $hash, 'user' => $user));
    $this->assertTrue(file_exists($p->file_path('3.4.5')));
  }
}

?>
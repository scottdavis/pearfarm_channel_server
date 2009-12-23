<?php
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
require_once (NIMBLE_ROOT . '/lib/package_extractor.php');
class TestFileUpload extends PHPUnit_Framework_TestCase {
  
  public function testUpload() {
    $localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'PHPUnit-3.4.5.tar');
    $p = Package::from_upload(array('file' => $localfile, 'user' => User::find('first')->api_key));
    $this->assertTrue(file_exists($p->file_path('3.4.5')));
  }
}

?>
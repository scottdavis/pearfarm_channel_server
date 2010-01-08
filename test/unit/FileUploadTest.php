<?php
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
require_once (NIMBLE_ROOT . '/lib/package_extractor.php');
require_once (NIMBLE_ROOT . '/lib/story_helper.php');
require_once(__DIR__ . '/PackageVerifyTest.php');

class FileUploadTest extends NimbleUnitTestCase {
  public function testUploadFail() {
    $localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'nimblize-0.0.1.tgz');
    $user = User::find('first');
    try {
      $p = Package::from_upload(array('file' => $localfile, 'user' => $user));
    }
    catch(Exception $e) {
      $this->assertEquals('Package channel pear.nimblize.com does not match bob.localhost.com', $e->getMessage());
    }
  }

  public function testUpload() {
    $localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'bobs_other_package-1.0.4.tgz');
    $sig = PackageVerifyTest::calculatePackageSignature($localfile);
    $user = User::find_by_username('bob');
    $p = Package::from_upload(array('file' => $localfile, 'sig' => $sig, 'user' => $user), true);
    $this->assertTrue(file_exists($p->file_path('1.0.4')));
  }


  public function testUploadFailbadSig() {
    $localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'joes_other_package-1.0.4.tgz');
    $sig = PackageVerifyTest::calculatePackageSignature($localfile);
    $user = User::find_by_username('joe');
		try{	
    	$p = Package::from_upload(array('file' => $localfile, 'sig' => $sig, 'user' => $user), true);
		}catch(NimbleException $e) {
			$this->assertEquals("Invalid package signature", $e->getMessage());
		}
  }


}
?>
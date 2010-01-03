<?php
/**	
 * @package functional_test
 */
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class ChannelControllerTest extends NimbleFunctionalTestCase {
  public function setUp() {
    $_SERVER['SERVER_NAME'] = 'bob.localhost';
  }
  public function testGetsChannelXml() {
    $this->get('index', array(), array(), array(), 'xml');
    $this->assertTemplate('index.xml');
  }
  public function testGetsChannelHtml() {
    $this->get('index', array(), array(), array('user' => User::find_by_username('bob')->id));
    $this->assertTemplate('index');
  }

	public function testGetAdd() {
		$this->get('add', array(), array(), array('user' => User::find_by_username('bob')->id));
		$this->assertTrue(isset($_SESSION['upload_key']));
	}
	
	public function testUploadFromXML() {
		require_once(__DIR__ . '/../unit/PackageVerifyTest.php');
		$localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'bobs_other_package-1.0.4.tgz');
    $sig = PackageVerifyTest::calculatePackageSignature($localfile);
		$_FILES = array();
		$_FILES['file'] = array();
		$_FILES['file']['tmp_name'] = $localfile;
		$key = md5(time());
		$this->post('upload', array(), array('signatureBase64' => $sig), array(), 'xml');
		$this->responseIncludes('Package uploaded succesfuly!');
	}
	
	public function testUploadFromXMLFailedBadSig() {
		require_once(__DIR__ . '/../unit/PackageVerifyTest.php');
		$localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'bobs_other_package-1.0.4.tgz');
    $sig = md5(PackageVerifyTest::calculatePackageSignature($localfile));
		$_FILES = array();
		$_FILES['file'] = array();
		$_FILES['file']['tmp_name'] = $localfile;
		$key = md5(time());
		$this->post('upload', array(), array('signatureBase64' => $sig), array(), 'xml');
		$this->responseIncludes('Invalid package signature');
		$this->assertResponse('error');
	}

	public function testUploadHtml() {
		$localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'bobs_other_package-1.0.4.tgz');
		$_FILES = array();
		$_FILES['file'] = array();
		$_FILES['file']['tmp_name'] = $localfile;
		$key = md5(time());
		$this->post('upload', array(), array('upload_key' => $key), array('upload_key' => $key, 'user' => User::find_by_username('bob')->id), 'html');
		$this->assertRedirect(url_for('LandingController', 'user_index', User::find_by_username('bob')->username));
	}

	public function testUploadHtmlFailsBadKey() {
		$localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'bobs_other_package-1.0.4.tgz');
		$_FILES = array();
		$_FILES['file'] = array();
		$_FILES['file']['tmp_name'] = $localfile;
		$key = md5(time());
		$this->post('upload', array(), array('upload_key' => $key), array('upload_key' => md5(md5(time())), 'user' => User::find_by_username('bob')->id), 'html');
		$this->assertEquals($_SESSION['flashes']['notice'], 'Invalid Upload Key');
		$this->assertRedirect(url_for('LandingController', 'user_index', User::find_by_username('bob')->username));
	}
	
	public function testUploadHtmlFailsnoFile() {
		$localfile = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'bobs_other_package-1.0.4.tgz');
		$_FILES = array();
		$_FILES['file'] = array();
		$_FILES['file']['tmp_name'] = '';
		$key = md5(time());
		$this->post('upload', array(), array('upload_key' => $key), array('upload_key' => md5(md5(time())), 'user' => User::find_by_username('bob')->id), 'html');
		$this->assertEquals($_SESSION['flashes']['notice'], 'Package channel  does not match bob.localhost.com');
		$this->assertRedirect(url_for('LandingController', 'user_index', User::find_by_username('bob')->username));
	}

}
?>
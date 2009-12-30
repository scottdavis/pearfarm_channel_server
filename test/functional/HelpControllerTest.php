<?php
/**	
 * @package functional_test
 */
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class HelpControllerTest extends NimbleFunctionalTestCase {

  public function testGetIndex() {
		$this->get('index', array(), array());
		$this->assertTemplate('index');
  }

	public function testGetHelp() {
		$_SERVER['SERVER_NAME'] = 'bob.localhost.com';
		$dir = FileUtils::join(NIMBLE_ROOT, 'app', 'view', 'help', 'markdown');
		foreach(HelpController::get_markdown_files($dir) as $help) {
			
			$name = substr(basename($help), 0, -9);
			$this->get('show', array(), array('name' => $name));
			$this->responseIncludes(ucwords(Inflector::humanize($name)));
			$this->controller = new HelpController();
		}
	}

	

}
?>
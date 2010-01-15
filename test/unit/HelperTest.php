<?php
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
require_once (NIMBLE_ROOT . '/lib/helper.php');
class HelperTest extends NimbleUnitTestCase {
	
	public function testAutoUrl() {
		$url = 'http://githu.com/fgrehm/pearfarm';
		$out = autolink('bar ' . $url . ' foo');
		$this->assertEquals($out, 'bar ' . TagHelper::content_tag('a', $url, array('href' => $url, 'title' => $url, 'target' => '_blank')). ' foo');
	}
	
}
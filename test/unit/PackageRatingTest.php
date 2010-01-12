<?php
	/**
		* @package unit_test	
		*/
	require_once('nimblize/nimble_test/lib/phpunit_testcase.php');
  class PackageRatingUnitTest extends NimbleUnitTestCase { 
  	

		public function testGetRaiting() {
			$p = Package::find_by_name('bobs_other_package');
			$rating = PackageRating::get_rating_for($p->id);
			$this->assertEquals(0.25, $rating);
		}

		public function testConvertToHuman() {
			$p = Package::find_by_name('bobs_other_package');
			$rating = PackageRating::get_rating_for($p->id);
			$this->assertEquals(0.25, $rating);
			$human = PackageRating::convert_to_human($rating);
			$this->assertEquals(25, $human);
		}
		
		/**
			* @expectedException NimbleRecordException
			*/
		public function testBobTriesToRatePackageThatsRaitedByBob() {
			$p = Package::find_by_name('bobs_other_package');
			$user = $p->user;
			PackageRating::create(array('user_id' => $user->id, 'package_id' => $p->id, 'rating' => 0.1));
		}

	}
?>
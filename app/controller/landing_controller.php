<?php
/**
 * @package controller
 */
class LandingController extends \ApplicationController {
  public function index() {
		$this->packages = Package::find('all');
  }
}

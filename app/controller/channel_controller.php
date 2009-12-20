<?php
	
	/**
		* @package controller
		*/
	class ChannelController extends \ApplicationController {
		  /**
   * index
   */
  public function index() {
		if($this->format == 'xml') {
			$this->layout = false;
			$this->header('Content-Type: text/xml', 200);
			$this->render('channel/index.xml');
		}
	}
	
	}
?>
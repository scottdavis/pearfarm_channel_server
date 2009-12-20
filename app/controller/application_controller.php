<?php
	
	/**
		* @package controller
		*/
	class ApplicationController extends \Controller {
		
		public function before_filter() {
			$array = explode('.', $_SERVER['SERVER_NAME']);
			$subdomain = reset($array);
			$this->user = User::find_by_username($subdomain);
		}
		
		
	}
?>
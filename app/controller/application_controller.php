<?php
	/**
		* @package controller
		*/
	class ApplicationController extends \Controller {
		
		public function before_filter() {
			$headers = apache_request_headers();
			$array = explode('.', $_SERVER['SERVER_NAME']);
			$subdomain = reset($array);
			$this->user = User::find_by_username($subdomain);
			if(strpos($headers['User-Agent'], 'PEAR') !== false) {
				$time = DateHelper::from_db($this->user->updated_at);
				//$this->header("Last-Modified: " . gmdate("D, d M Y H:i:s", time() - 100) . " GMT", 304);
			}
			$this->header('Content-Type: text/xml');
		}
		
		
	}
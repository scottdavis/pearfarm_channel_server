<?php
	
	/**
		* @package controller
		*/
	class SearchController extends \ApplicationController {
		public function search() {
			try {
				$this->packages = PackageSearch::simple_search($_GET['search']);
			}catch(NimbleRecordNotFound $e) {
				$this->packages = array();
			}
			switch($this->format) {
				case 'xml':
				  echo $this->packages->to_xml(array('except' => array('user_id'), 'append' => array('channel' => function($obj) {
				                                                                                      return $obj->user->pear_farm_url();
				                                                                                    }, 'username' => function($obj) {
				                                                                                      return $obj->user->username;
				                                                                                    })));
					$this->layout = false;
				  $this->has_rendered = true;
				break;
				case 'json':
				  $names = collect(function($p){return $p->name;}, $this->packages);
				  echo json_encode(array($_GET['search'], $names));
				  $this->layout = false;
				  $this->has_rendered = true;
				break;
				case 'html':
				  $this->full = true;
  			  $this->set_default_side_bar();
				  if(!isset($_GET['search']) || empty($_GET['search']) || $_GET['search'] == 'Search packages…') {
				    $this->redirect_to('/');
				  }
				break;
			}
		}
		
		public function opensearch() {
		  $this->header('Content-Type: text/xml', 200);
		  $this->layout = false;
		}
		
	}
?>
<?php
	
	/**
		* @package controller
		*/
	class SearchController extends \ApplicationController {
		
		public function search() {
			$this->set_default_side_bar();
			$this->packages = PackageSearch::simple_search($_GET['search']);
			switch($this->format) {
				case 'xml':
					$this->render('search/search.xml');
				break;
				case 'json':
				  $names = collect(function($p){return $p->name;}, $this->packages);
				  echo json_encode(array($_GET['search'], $names));
				  $this->layout = false;
				  $this->has_rendered = true;
				break;
				case 'html':
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
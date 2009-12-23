<?php
	/**
		* @package model
		*/
		
		class Package extends NimbleRecord {
			
			public function associations() {
				/**
					* Association loading goes here ex. 
					* $this->has_many('foo')
					* $this->belongs_to('bar')
					*/
					$this->belongs_to('user');
					$this->has_many('versions');
					$this->has_many('maintainers');
					$this->belongs_to('category');
			}
			
			public function validations() {
				/**
					* Column validations go here ex.
					* $this->validates_presance_of('foo')
					*/
					
				$this->validates_presance_of('name');
			}
			
			public function link() {
				$name = urlencode($name);
				return "/rest/p/$name";
			}
			
			public function file_url($version) {
			  $url = $this->username . DOMAIN; 
			  return "http://$url/get/{$this->user->username}/{$this->name}-$version.tgz";
			}
			
			public function file_path($version) {
			  return FileUtils::join(NIMBLE_ROOT, 'get', $this->user->username, "{$this->name}-$version.tgz");
			}
			
			
		
		}

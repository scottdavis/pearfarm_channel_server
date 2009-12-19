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
					$this->has_many('packages');
			}
			
			public function validations() {
				/**
					* Column validations go here ex.
					* $this->validates_presance_of('foo')
					*/
					
				$this->validates_presance_of('name');
			}
			
			
		
		}

?>
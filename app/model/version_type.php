<?php
	/**
		* @package model
		*/
		
		class VersionType extends NimbleRecord {
			
			public function associations() {
				/**
					* Association loading goes here ex. 
					* $this->has_many('foo')
					* $this->belongs_to('bar')
					*/
					$this->has_many('versions');
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
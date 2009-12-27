<?php
	/**
		* @package model
		*/
		
		class Pki extends NimbleRecord {
			
			public function associations() {
				/**
					* Association loading goes here ex. 
					* $this->has_many('foo')
					* $this->belongs_to('bar')
					*/
					$this->belongs_to('user');
			}
			
			public function validations() {
				/**
					* Column validations go here ex.
					* $this->validates_presence_of('foo')
					*/
					$this->validates_presence_of('key');
					$this->validates_presence_of('name');
			}
			
			
		
		}

?>
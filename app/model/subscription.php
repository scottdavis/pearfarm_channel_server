<?php
	/**
		* @package model
		*/
		
		class Subscription extends NimbleRecord {
			
			public function associations() {
				/**
					* Association loading goes here ex. 
					* $this->has_many('foo')
					* $this->belongs_to('bar')
					*/
					$this->belongs_to('user');
					$this->belongs_to('package');
			}
			
			public function validations() {
				/**
					* Column validations go here ex.
					* $this->validates_presence_of('foo')
					*/
			}
			
			
		
		}

?>
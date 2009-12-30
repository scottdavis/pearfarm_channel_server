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
					$this->validates_format_of('key', array('with' => '/^-{5}BEGIN\sPUBLIC\sKEY-{5}[(\n|\r\n)A-Za-z0-9\/\+\=]+-{5}END\sPUBLIC\sKEY-{5}$/'));
			}
			
			public function before_save() {
				$this->key = trim($this->key);
			}
			
		
		}

?>
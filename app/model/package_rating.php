<?php
	/**
		* @package model
		*/
		
		class PackageRating extends NimbleRecord {
			
			public function associations() {
				/**
					* Association loading goes here ex. 
					* $this->has_many('foo')
					* $this->belongs_to('bar')
					*/
			}
			
			public function validations() {
				/**
					* Column validations go here ex.
					* $this->validates_presence_of('foo')
					*/
					
					$this->validates_presence_of('rating');
					
			}
			
			
			public function before_save() {
				try {
					self::find('first', array('conditions' => array('package_id' => $this->package_id, 'user_id' => $this->user_id)));
					throw new NimbleRecordException("This user has already rated this package");
				}catch(NimbleRecordNotFound $e) {
					return;
				}
			}
			
			
			public static function get_rating_for($package_id) {
				return self::avg(array('column' => 'rating', 'conditions' => array('package_id' => $package_id)));
			}
			
			public static function convert_to_human($num) {
				return number_format(100 * (float) $num, 0);
			}
		
		}

?>
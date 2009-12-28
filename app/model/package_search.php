<?php

class PackageSearch {
	
	var $name ='';
	var $user = '';
	
	
	public static function simple_search($value) {
	  $page = isset($_GET['page']) ? $_GET['page'] : NULL;
		return Package::paginate(array('order' => 'updated_at DESC', 'per_page' => 20, 'page' => $page, 'conditions' =>  NimbleRecord::sanitize(array('name LIKE ?', "%$value%"))));
	}
	
	
	public function __construct(array $args) {
		foreach($args as $var => $value) {
			$this->{$var} = $value;
		}
	}
	
	public function name_conditions() {
		return (!empty($this->$name)) ? array('name LIKE ?', "%$this->name%") : '';
	}
	
	public function search() {
		$methods = get_class_methods($this);
		$sql = array();
		foreach($methods as $method) {
			 $matches = array();
			if(preg_match('/([a-zA-z0-9_]+)_conditions$/', $method, $matches)) {
					$retrun = call_user_func(array($this, $method));
					if(!empty($return)) {
						$sql[] = NimbleRecord::sanitize($return);
					}
			}
		}
		$conditions =  implode(' ', $sql);
		return Package::find_all(array('conditions' => $conditions));
	}
	
	
}

?>
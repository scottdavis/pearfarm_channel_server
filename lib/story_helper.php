<?php

	class StoryHelper {
		
		public function up() {
			$this->down();
			static::create_version_types();
			static::create_users();
			static::create_packages();
			static::create_versions();
		}
		
		public function down() {
			$tables = array('User', 'Package', 'Version');
			foreach(array_reverse($tables) as $table) {
				$table::delete_all();
			}
		}
		
		public static function create_users() {
			User::create(array('username' => 'bob', 'password' => 'password'));
			User::create(array('username' => 'joe', 'password' => 'password'));
			User::create(array('username' => 'jim', 'password' => 'password'));
		}
		
		
		public static function create_packages() {
			foreach(User::find_all() as $user) {
				Package::create(array('user_id' => $user->id, 'name' => $user->username . '\'s pear package'));
			}
		}
		
		public static function create_version_types() {
			foreach(array('stable', 'beta', 'alpha') as $version) {
				VersionType::create(array('name' => $version));
			}
		}
		
		
		public static function create_versions() {
			$version_types = collect(function($vt){return $vt->id;}, VersionType::find_all());
			foreach(Package::find_all() as $package) {
				foreach($version_types as $i) {
					Version::create(array('package_id' => $package->id, 'version' => "0.$i.0", 'version_type_id' => $i));
				}
			}
		}
		
	}

?>
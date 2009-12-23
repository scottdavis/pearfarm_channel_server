<?php
	require_once(NIMBLE_ROOT . '/lib/package_extractor.php');
	class StoryHelper {
		
		public function up() {
			$this->down();
			static::create_categories();
			static::create_version_types();
			static::create_users();
			static::create_packages();
			static::create_versions();
			static::create_maintainers();
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
				Package::create(array('user_id' => $user->id, 'name' => $user->username . 's_pear_package', 'category_id' => Category::find_by_name('Default')->id));
			}
		}
		
		public static function create_maintainers() {
			foreach(Package::find_all() as $package) {
				foreach(Maintainer::$types as $type) {
					Maintainer::create(array('url' => 'http://nimblize.com', 'package_id' => $package->id, 'type' => $type, 'name' => $type ."_dude", 'email' => 'dude@nimblize.com', 'user' => 'duder', 'active' => 'yes'));
				}
			}
		}
		
		public static function create_version_types() {
			foreach(array('stable', 'beta', 'alpha', 'devel') as $version) {
				VersionType::create(array('name' => $version));
			}
		}
		
		public static function create_categories() {
			Category::create(array('name' => 'Default', 'description' => 'A Default Category'));
		}
		
		public static function create_versions() {
			$package = new PackageExtractor(__DIR__ . '/../test/data/nimblize-0.1.0.tgz');
			$data = $package->serialized();
			$version_types = collect(function($vt){return $vt->id;}, VersionType::find_all());
			foreach(Package::find_all() as $package) {
				foreach($version_types as $i) {
					Version::create(array('package_id' => $package->id, 'version' => "0.$i.0", 'version_type_id' => $i, 'meta' => $data));
				}
			}
		}
		
	}

?>
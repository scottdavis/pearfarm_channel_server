<?php
require_once (NIMBLE_ROOT . '/lib/package_extractor.php');
class StoryHelper {
  public function up() {
    $this->down();
    static ::create_categories();
    static ::create_version_types();
    static ::create_users();
    static ::create_packages();
    static ::create_maintainers();
  }
  public function down() {
    $tables = array('User', 'Package', 'Version');
    foreach(array_reverse($tables) as $table) {
      $table::delete_all();
    }
  }
  public static function create_users() {
    User::_create(array('username' => 'bob', 'password' => 'password', 'email' => 'whoa@pearfarm.org', 'active' => true));
    User::_create(array('username' => 'joe', 'password' => 'password', 'email' => 'whoa@pearfarm.org'));
    User::_create(array('username' => 'jim', 'password' => 'password', 'email' => 'whoa@pearfarm.org'));
  }
  public static function create_packages() {
		$user = User::find_by_username('bob');
		$file = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'bobs_other_package-0.0.1.tgz');
		Package::from_upload(array('file' => $file, 'user' => $user));
  }
  public static function create_maintainers() {
    foreach(Package::find_all() as $package) {
      foreach(Maintainer::$types as $type) {
        Maintainer::create(array('url' => 'http://nimblize.com', 'package_id' => $package->id, 'type' => $type, 'name' => $type . "_dude", 'email' => 'dude@nimblize.com', 'user' => 'duder', 'active' => 'yes'));
      }
    }
  }

  public static function create_categories() {
    Category::create(array('name' => 'Default', 'description' => 'A Default Category'));
  }
  

  public static function create_version_types() {
    foreach(array('stable', 'beta', 'alpha', 'devel') as $version) {
      VersionType::create(array('name' => $version));
    }
  }
}
?>
<?php
require_once (NIMBLE_ROOT . '/lib/package_extractor.php');
class StoryHelper {
  public function up() {
    $this->down();
    static::create_categories();
    static::create_version_types();
    static::create_users();
    static::create_pkis();
    static::create_package();
  }
  public function down() {
    $tables = array('User', 'Package', 'Version');
    foreach(array_reverse($tables) as $table) {
      $table::delete_all();
    }
  }
  public static function create_users() {
   	$u = User::_create(array('username' => 'bob', 'password' => 'password', 'email' => 'whoa@pearfarm.org'));
		$u->active = true;
		$u->save();
    User::_create(array('username' => 'joe', 'password' => 'password', 'email' => 'whoa@pearfarm.org'));
    User::_create(array('username' => 'jim', 'password' => 'password', 'email' => 'whoa@pearfarm.org'));
    $u = User::_create(array('username' => 'steve', 'password' => 'password', 'email' => 'whoa@pearfarm.org'));
		$u->active = true;
		$u->save();
  }
  public static function create_package() {
		$user = User::find_by_username('bob');
		$file = FileUtils::join(NIMBLE_ROOT, 'test', 'data', 'bobs_other_package-0.0.1.tgz');
		$package = Package::from_upload(array('file' => $file, 'user' => $user));
		foreach(User::_find('all') as $user) {
			$raiting = '0.' . $user->id;
			PackageRating::_create(array('user_id' => $user->id, 'package_id' => $package->id, 'rating' => (float) $raiting));
		}
  }


  public static function create_categories() {
    Category::_create(array('name' => 'Default', 'description' => 'A Default Category'));
  }
  

  public static function create_version_types() {
    foreach(array('stable', 'beta', 'alpha', 'devel') as $version) {
      VersionType::_create(array('name' => $version));
    }
  }
  
  public static function create_pkis() {
    $key = file_get_contents(getenv('HOME') . '/.ssh/id_openssl.pub');
		$user = User::find_by_username('bob');
    Pki::_create(array('key' => $key, 'name' => 'my Key', 'user_id' => $user->id));
  }
  
  
}
?>
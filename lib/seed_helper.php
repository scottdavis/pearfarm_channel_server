<?php

class SeedHelper {
  
  public function up() {
    $this->down();
    StoryHelper::create_categories();
    StoryHelper::create_version_types();
		static::create_pearfarm_user();
  }
  public function down() {
    $tables = array('User', 'Package', 'Version');
    foreach(array_reverse($tables) as $table) {
      $table::delete_all();
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


	public function creat_pearfarm_user() {
		$u = User::_create(array('username' => 'pearfarm', 'password' => 'mmm_pears', 'email' => 'jetviper21@gmail.com'));
		$u->active = true;
		$u->save();
	}

}
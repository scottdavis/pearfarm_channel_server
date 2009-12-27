<?php

class SeedHelper {
  
  public function up() {
    $this->down();
    static ::create_categories();
    static ::create_version_types();
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
}
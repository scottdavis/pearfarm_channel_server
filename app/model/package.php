<?php
require_once(FileUtils::join(NIMBLE_ROOT, 'lib', 'package_extractor.php'));
/**
 * @package model
 */
class Package extends NimbleRecord {
  public function associations() {
    /**
     * Association loading goes here ex.
     * $this->has_many('foo')
     * $this->belongs_to('bar')
     */
    $this->belongs_to('user');
    $this->has_many('versions');
    $this->has_many('maintainers');
    $this->belongs_to('category');
  }
  public function validations() {
    /**
     * Column validations go here ex.
     * $this->validates_presance_of('foo')
     */
    $this->validates_presance_of('name');
  }
  public function link() {
    $name = urlencode($this->name);
    return "/rest/p/$name";
  }
  public function file_url($version) {
    $url = $this->user->username . '.' . DOMAIN;
    return "http://$url/get/{$this->user->username}/{$this->name}-$version.tgz";
  }
  public function file_path($version) {
    return FileUtils::join(NIMBLE_ROOT, 'get', $this->user->username, "{$this->name}-$version.tgz");
  }
  
  
  public static function from_upload(array $data) {
    $create = array();
    $file = $data['file'];
    $user = User::find('first', array('conditions' => array('api_key' => $data['user'])));
    $package_data = new PackageExtractor($file);
    $name = $package_data->data['name'];
    $version = $package_data->data['version']['release'];
    $stability = $package_data->data['stability']['release'];
    if(!Package::exists(array('name' => $name, 'user_id' => $user->id))) {
      $package = new Package(array('name' => $name, 'user_id' => $user->id, 'category_id' => Category::find_by_name('Default')->id));
    }else{
      $package = Package::find('first', array('conditions' => array('name' => $name, 'user_id' => $user->id)));
    }
    $package->move_uploaded_file($file, $version);
    $type = VersionType::find_by_name($stability);
    $package->versions = array(array('version' => $version, 'meta' => serialize($package_data->data), 'version_type_id' => $type->id));
    $package->save();
    return $package;
  }
  
  public function move_uploaded_file($file, $version) {
    $path = $this->file_path($version);
    FileUtils::mkdir_p(dirname($path));
    if(is_uploaded_file($file)) {
      move_uploaded_file($file, $this->file_path($version));
    }else{
      copy($file, $path);
    }
  }
  
  
}

<?php
require_once (FileUtils::join(NIMBLE_ROOT, 'lib', 'package_extractor.php'));
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
    $this->belongs_to('category');

		$this->has_many('ratings');
    $this->has_many('versions')->order('created_at DESC');
  }
  
  public function validations() {
    /**
     * Column validations go here ex.
     * $this->validates_presence_of('foo')
     */
    $this->validates_presence_of('name');
  }
  
  public function current_version() {
    try{
      return Version::find('first', array('order' => 'created_at DESC', 'conditions' => array('package_id' => $this->id)));
    }catch(NimbleRecordNotFound $e) {
      return false;
    }
  }
  
  public function clear_all_versions() {
    foreach($this->versions as $version) {
      @unlink($this->file_path($version->version));
      $version->delete();
    }
  }
  
  public function link() {
    $name = urlencode($this->name);
    return "/rest/p/$name";
  }
  
  public function file_url($version) {
    $url = $this->user->username . '.' . DOMAIN;
    return "http://$url/get/{$this->user->username}/{$this->name}-$version";
  }
  
  public function file_path($version) {
    return FileUtils::join(NIMBLE_ROOT, 'get', $this->user->username, "{$this->name}-$version.tgz");
  }
  
  
  public static function from_upload(array $data, $key_mode = false) {
    $create = array();
    $file = $data['file'];
    $user = $data['user'];
    if($key_mode) {
      $keys = collect(function($key){return $key->key;}, Pki::find('all', array('select' => '`key`', 'conditions' => array('user_id' => $user->id))));
      $sig = $data['sig'];
			if(!static::verify($file, $sig, $keys)) {
				throw New NimbleException('Invalid package signature');
			}
    }
    $package_data = new PackageExtractor($file);
    if ($user->pear_farm_url() !== $package_data->data['channel']) {
      throw new Exception('Package channel ' . $package_data->data['channel'] . ' does not match ' . $user->pear_farm_url());
    }
    $name = $package_data->data['name'];
    $version = $package_data->data['version']['release'];
    $stability = $package_data->data['stability']['release'];
    if (!Package::exists(array('name' => $name, 'user_id' => $user->id))) {
      $package = new Package(array('name' => $name, 'user_id' => $user->id, 'category_id' => Category::find_by_name('Default')->id));
    } else {
      $package = Package::find('first', array('conditions' => array('name' => $name, 'user_id' => $user->id)));
    }
		if(!$package->new_record && Version::exists(array('version' => $version, 'package_id' => $package->id))) {
			throw new NimbleException("There is already a $version. You cannot replace existing packages. Please bump the version number and try again." .
																" You can delete a version from the web interface if needed.");
			}
    $package->move_uploaded_file($file, $version);
    $type = VersionType::find_by_name($stability);
    $package->versions = array(array('raw_xml' => $package_data->get_package_xml(), 
																		 'version' => $version, 
																		 'meta' => serialize($package_data->data), 
																		 'version_type_id' => $type->id,
																		 'summary' => $package_data->data['summary'],
																		 'description' =>$package_data->data['description'],
																		 'min_php' => $package_data->data['dependencies']['required']['php']['min']));
    $package->save();
    return $package;
  }
  
  public static function verify($file, $sig, $keys) {
    if(!is_array($keys)) {
      $keys = array($keys);
    }
    $file_hash = sha1_file($file, true);
    $sig = base64_decode($sig);
    foreach($keys as $key) {
      $key = openssl_pkey_get_public($key);
			if(!is_resource($key)) {continue;}
      switch(openssl_verify($file_hash, $sig, $key, OPENSSL_ALGO_SHA1)) {
        case 1:
          return true;
        break;
        case 0:
          continue;
          break;
        case -1:
          continue;
          break;
      }
    }
		unset($sig);
    unset($file_hash);
    return false;
  }
  
  
  
  public function move_uploaded_file($file, $version) {
    $path = $this->file_path($version);
    FileUtils::mkdir_p(dirname($path));
    if (is_uploaded_file($file)) {
      move_uploaded_file($file, $this->file_path($version));
			chmod($this->file_path($version), 0664);
    } else {
      copy($file, $path);
    }
  }
}

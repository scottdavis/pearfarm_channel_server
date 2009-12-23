<?php
/**
 * @package model
 */
class User extends NimbleRecord {
  public function associations() {
    /**
     * Association loading goes here ex.
     * $this->has_many('foo')
     * $this->belongs_to('bar')
     */
    $this->has_many('packages');
  }
  public function validations() {
    /**
     * Column validations go here ex.
     * $this->validates_presence_of('foo')
     */
    $this->validates_presence_of('username');
    $this->validates_presence_of('password');
  }
  public function pear_farm_url() {
    return implode(".", array($this->username, DOMAIN));
  }
  public function before_create() {
    $this->api_key = md5(time() . $this->username . rand(0, 4000));
    $this->salt = static ::generate_salt();
    $this->password = static ::hash_password($this->password, $this->salt);
  }
  public static function hash_password($password, $salt) {
    return hash("sha256", $password . $salt);
  }
  public static function generate_salt() {
    return sha1(md5(rand(0, 500) . time()));
  }
  public static function authenticate($username, $password) {
    $user = User::find_by_username($username);
    $hashed_password = static ::hash_password($password, $user->salt);
    return ($hashed_password === $user->password);
  }
}

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
     * $this->validates_presance_of('foo')
     */
    $this->validates_presance_of('username');
    $this->validates_presance_of('password');
  }
  public function pear_farm_url() {
    return implode(".", array($this->username, DOMAIN));
  }
  public function before_create() {
    $this->api_key = md5(time() . $this->username . rand(0, 4000));
  }
}

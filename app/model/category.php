<?php
/**
 * @package model
 */
class Category extends NimbleRecord {
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
    $this->validates_presance_of('name');
    $this->validates_presance_of('description');
  }
  public function alias() {
    return $this->name;
  }
  public function link() {
    $name = urlencode($this->name);
    return "/rest/c/$name/info.xml";
  }
}

<?php
/**
 * @package model
 */
class Version extends NimbleRecord {
  public function associations() {
    /**
     * Association loading goes here ex.
     * $this->has_many('foo')
     * $this->belongs_to('bar')
     */
    $this->belongs_to('package');
    $this->belongs_to('version_type');
  }
  public function validations() {
    /**
     * Column validations go here ex.
     * $this->validates_presence_of('foo')
     */
    $this->validates_presence_of('version');
		$this->validates_format_of('version', array('with' => '/^[0-9A-za-z\.]+$/'));
  }
  public function package_data() {
    return unserialize($this->meta);
  }
}

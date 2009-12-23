<?php
/**
 * @package model
 */
class Maintainer extends NimbleRecord {
  static $types = array('lead', 'developer', 'helper');
  public function associations() {
    /**
     * Association loading goes here ex.
     * $this->has_many('foo')
     * $this->belongs_to('bar')
     */
    $this->belongs_to('package');
  }
  public function validations() {
    /**
     * Column validations go here ex.
     * $this->validates_presance_of('foo')
     */
  }
}

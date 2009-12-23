<?php
/**
 * @package controller
 */
class ChannelController extends \ApplicationController {
  /**
   * index
   */
  public function index() {
    if ($this->format == 'xml') {
      $this->layout = false;
      $this->render('channel/index.xml');
      $this->header('Content-Type: text/xml', 200);
    }
  }
  
  
  public function upload() {
    $p = Package::from_upload(array('file' => $_FILES['file']['tmp_name'], 'user' => $_POST['user']));
    var_dump($p);
  }
  
}

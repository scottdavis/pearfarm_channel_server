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
  
  /**
    * This handles uploads to a persions channel
    * Need file posted as 'file' and the has poster as 'hash'
    */
  public function upload() {
    $p = Package::from_upload(array('file' => $_FILES['file']['tmp_name'], 'hash' => $_POST['hash'], 'user' => $this->user));
    echo ($package->saved) ? 'true' : 'false';
    $this->has_rendered = true;
  }
  
}

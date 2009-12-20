<?php
	
	/**
		* @package controller
		*/
	class ChannelController extends \ApplicationController {
		  /**
   * index
   */
  public function index() {
		if($this->format == 'xml') {
			$this->layout = false;
			$this->header('Content-Type: text/xml', 200);
			$this->render('channel/index.xml');
		}
	}
  /**
   * add
   */
  public function add() {

}
  /**
   * create
   */
  public function create() {

}
  /**
   * update
   * @param $id string The unique identifier for this object.
   */
  public function update($id) {

}
  /**
   * delete
   * @param $id string The unique identifier for this object.
   */
  public function delete($id) {

}
  /**
   * show
   * @param $id string The unique identifier for this object.
   */
  public function show($id) {

}
  /**
   * edit
   * @param $id string The unique identifier for this object.
   */
  public function edit($id) {

}

	}
?>
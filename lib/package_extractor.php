<?php
require_once ('Archive/Tar.php');
require_once ('PEAR/XMLParser.php');
/**
 * This class extracts the package.xml from the tar archive and parses it for easy database insertion
 * @package PearFarm
 * @todo return developers
 */
class PackageExtractor {
  /**
   * @param string $tar - path to tar file
   */
  public function __construct($tar) {
    $tar = new Archive_Tar($tar);
    $this->package_xml = $tar->extractInString('package.xml');
    unset($tar);
    $this->parse_package();
  }
  /**
   * returns the xml contents of the package.xml extracted
   */
  public function get_package_xml() {
    return $this->package_xml;
  }
  /**
   * creates a simplexml object
   */
  public function parse_package() {
    $obj = new PEAR_XMLParser();
    $obj->parse($this->package_xml);
    $this->data = $obj->getData();
  }
  /**
   * Returns the name from the <name></name> tags
   * @return string
   */
  public function name() {
    return $this->data['name'];
  }
  /**
   * Returns the channel name from the <channel></channel> tags
   * @return string
   */
  public function channel() {
    return $this->data['channel'];
  }
  /**
   * Returns the summary from the <summary></summary> tags
   * @return string
   */
  public function summary() {
    return $this->data['summary'];
  }
  /**
   * Returns the description from the <description></description> tags
   * @return string
   */
  public function description() {
    return $this->data['description'];
  }
  /**
   * Returns the lead developers information
   * @return array
   */
  public function lead() {
    return $this->data['lead'];
  }
  /**
   * Returns the date from the <date></date> tags
   * @return string
   */
  public function date() {
    return $this->data['date'];
  }
  /**
   * Returns the time from the <time></time> tags
   * @return string
   */
  public function time() {
    return $this->data['time'];
  }
  /**
   * Returns the version information
   * @return array
   */
  public function version() {
    return $this->data['version'];
  }
  /**
   * Returns stability informations
   * @return array
   */
  public function stability() {
    return $this->data['stability'];
  }
  /**
   * Returns license information
   * @return array
   */
  public function license() {
    return $this->data['license'];
  }
  /**
   * Returns the notes from the <note></note> tag
   * @return string
   */
  public function notes() {
    return $this->data['notes'];
  }
  /**
   * Returns all the files in this package as arrays
   * @return array
   */
  public function files() {
    return $this->data['contents'];
  }
  /**
   * Returns the changelog information
   * @return array
   */
  public function changelog() {
    return $this->data['changelog'];
  }
  /**
   * Returns all the notes for the change logs
   * @return array
   */
  public function changelog_notes() {
    $changelog = $this->changelog();
    return collect(function ($cl) {
      return $cl['notes'];
    }, $changelog);
  }
  /**
   * Returns the package dependencies
   * @return array
   */
  public function dependencies() {
    return $this->data['dependencies'];
  }
  public function serialized() {
    return serialize($this->data);
  }
}

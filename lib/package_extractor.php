<?php
	require_once('Archive/Tar.php');
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
			$this->xml = simplexml_load_string($this->package_xml);
		}
		/**
			* Returns the name from the <name></name> tags
			* @return string 
			*/
		public function name() {
			return (string) $this->xml->name;
		}
		/**
			* Returns the channel name from the <channel></channel> tags
			* @return string
			*/
		public function channel() {
			return (string) $this->xml->channel;
		}
		/**
			* Returns the summary from the <summary></summary> tags
			* @return string
			*/
		public function summary() {
			return (string) $this->xml->summary;
		}		
		/**
			* Returns the description from the <description></description> tags
			* @return string
			*/
		public function description() {
			return (string) $this->xml->description;
		}
		/**
			* Returns the lead developers information
			* @return array
			*/
		public function lead() {
			$lead = $this->xml->lead;
			return array('name' => (string) $lead->name, 'user' => (string) $lead->user, 'email' => (string) $lead->email, 'active' => (string) $lead->active);
		}
		/**
			* Returns the date from the <date></date> tags
			* @return string
			*/
		public function date() {
			return (string) $this->xml->date;
		}
		/**
			* Returns the time from the <time></time> tags
			* @return string
			*/		
		public function time() {
			return (string) $this->xml->time;
		}
		/**
			* Returns the version information
			* @return array
			*/
		public function version() {
			$version = $this->xml->version;
			return array('release' => (string) $version->release, 'api' => (string) $version->api);
		}
		/**
			* Returns stability informations
			* @return array
			*/
		public function stability() {
			$stability = $this->xml->stability;
			return array('release' => (string) $stability->release, 'api' => (string) $stability->api);
		}
		/**
			* Returns license information
			* note: the license type is the key
			* @return array
			*/
		public function license() {
			$license = $this->xml->license;
			return array((string) $license => (string) $license['uri']);
		}
		/**
			* Returns the notes from the <note></note> tag
			* @return string
			*/
		public function notes() {
			return (string) $this->xml->notes;
		}
		/**
			* Returns all the files in this package as arrays
			* @return array
			*/
		public function files() {
			$out = array();
			$contents = $this->xml->contents->dir;
			foreach($contents->children() as $file) {
				$out[] = array('name' => (string) $file['name'], 'baseinstalldir' => (string) $file['baseinstalldir'], 'role' => (string) $file['role']);
			}
			return $out;
		}
		/**
			* Returns the changelog information
			* @return array
			*/
		public function changelog() {
			$out = array();
			$log = $this->xml->changelog;
			foreach($log->children() as $release) {
				$out[] = array('version' => array('release' => (string) $release->version->release, 'api' => (string) $release->version->api),
											 'stability' => array('release' => (string) $release->stability->release, 'api' => (string) $release->stability->api),
											 'date' => $release->date,
											 'license' => array((string) $release->license => (string) $release->license['uri']),
 											 'notes' => (string) $release->notes
											);
			}
			return $out;
		}
		/**
			* Returns all the notes for the change logs
			* @return array
			*/
		public function changelog_notes() {
			$changelog = $this->changelog();
			return collect(function($cl){return $cl['notes'];}, $changelog);
		}
	
	
	}

<?php
 		/**
 			* Templates in /Users/sdavis/Work/pearfarm_channel_server/app/view/version_mailer
			*/
			class VersionMailer extends NimbleMailer {
				
   public function foo($to) {
	  	$this->recipiants = $to;
	  	$this->from = '';
	  	$this->subject = '';
	  }

			}
			
		?>
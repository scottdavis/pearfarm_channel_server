<?php
 		/**
 			* Templates in /Users/sdavis/Work/pearfarm_channel_server/app/view/user_mailer
			*/
			class UserMailer extends NimbleMailer {
				
			   public function new_user($to, $user) {
				  	$this->recipiants = $to;
				  	$this->from = 'no-reply@pearfarm.org';
				  	$this->subject = 'New user activation pearfarm.org';
						$this->user = $user;
				  }

			}
			
		?>
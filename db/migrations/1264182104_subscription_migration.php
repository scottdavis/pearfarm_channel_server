<?php

	class SubscriptionMigration extends Migration {
		
		public function up() {
			$t = $this->create_table("subscriptions");
				//enter column definitions here
			$t->go();
		}
		
		public function down() {
				$this->drop_table("subscriptions");
		}
		
	}

?>
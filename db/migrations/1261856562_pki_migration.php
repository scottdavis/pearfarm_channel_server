<?php

	class PkiMigration extends Migration {
		
		public function up() {
			$t = $this->create_table("pkis");
				//enter column definitions here
			$t->go();
		}
		
		public function down() {
				$this->drop_table("pkis");
		}
		
	}

?>
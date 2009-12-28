<?php

	class RemoveMaintainersMigration extends Migration {
		
		public function up() {
			$this->drop_table("maintainers");
		}
		
		public function down() {
			
		}
		
	}

?>
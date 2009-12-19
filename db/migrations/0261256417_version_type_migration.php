<?php

	class VersionTypeMigration extends Migration {
		
		public function up() {
			$t = $this->create_table("version_types");
				$t->string('name');
			$t->go();
		}
		
		public function down() {
				$this->drop_table("version_types");
		}
		
	}

?>
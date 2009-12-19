<?php

	class VersionMigration extends Migration {
		
		public function up() {
			$t = $this->create_table("versions");
				$t->belongs_to('package');
				$t->string('version');
				$t->belongs_to('version_type');
				$t->text('meta');
			$t->go();
		}
		
		public function down() {
				$this->drop_table("versions");
		}
		
	}

?>
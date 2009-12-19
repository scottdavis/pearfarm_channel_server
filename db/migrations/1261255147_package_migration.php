<?php

	class PackageMigration extends Migration {
		
		public function up() {
			$t = $this->create_table("packages");
				$t->string('name');
				$t->belongs_to('user');
			$t->go();
		}
		
		public function down() {
				$this->drop_table("packages");
		}
		
	}

?>
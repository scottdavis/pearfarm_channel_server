<?php

	class MaintainerMigration extends Migration {
		
		public function up() {
			$t = $this->create_table("maintainers");
				$t->string('name');
				$t->string('email');
				$t->string('user');
				$t->string('active');
				$t->string('type');
				$t->string('url');
				$t->belongs_to('package');
			$t->go();
		}
		
		public function down() {
				$this->drop_table("maintainers");
		}
		
	}

?>
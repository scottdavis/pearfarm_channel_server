<?php

	class PkiMigration extends Migration {
		
		public function up() {
			$t = $this->create_table("pkis");
        $t->longtext('key');
        $t->string('name');
        $t->belongs_to('user');
			$t->go();
		}
		
		public function down() {
				$this->drop_table("pkis");
		}
		
	}

?>
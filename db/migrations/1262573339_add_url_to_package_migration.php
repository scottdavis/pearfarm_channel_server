<?php

	class AddUrlToPackageMigration extends Migration {
		
		public function up() {
			$table = $this->alter_table('packages');
				$table->string('url');
			$table->go();
		}
		
		public function down() {
			$table = $this->alter_table('packages');
				$table->remove('url');
			$table->go();			
		}
		
	}

?>
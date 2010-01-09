<?php

	class AddNumDownloadsToPackageMigration extends Migration {
		
		public function up() {
			$table = $this->alter_table('packages');
				$table->integer('num_downloads', array('default' => 0));
			$table->go();
		}
		
		public function down() {
			$table = $this->alter_table('packages');
				$table->remove('num_downloads');
			$table->go();
		}
		
	}

?>
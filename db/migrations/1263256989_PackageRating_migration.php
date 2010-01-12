<?php

	class PackageRatingMigration extends Migration {
		
		public function up() {
			$t = $this->create_table("package_ratings");
				$t->belongs_to('package');
				$t->belongs_to('user');
				$t->decimal('rating', array('precision' => 5, 'scale' => 3, 'default' => 0.000));
			$t->go();
		}
		
		public function down() {
				$this->drop_table("package_ratings");
		}
				
	}

?>
<?php

	class AddChannelUpdatedToUsersMigration extends Migration {
		
		public function up() {
			$table = $this->alter_table('users');
				$table->timestamp('channel_updated');
			$table->go();
			
			foreach(User::find_all() as $user) {
				$user->channel_updated = DateHelper::to_string('db', time());
				$user->save();
			}
		}
		
		public function down() {
			$table = $this->alter_table('users');
				$table->remove('channel_updated');
			$table->go();
		}
		
	}

?>
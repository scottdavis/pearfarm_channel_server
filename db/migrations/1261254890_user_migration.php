<?php
class UserMigration extends Migration {
  public function up() {
    $t = $this->create_table("users");
    $t->string('username');
    $t->string('password');
		$t->string('email');
    $t->string('salt');
    $t->string('api_key');
		$t->boolean('active', array('default' => 0));
    $t->timestamps();
    $t->go();
  }
  public function down() {
    $this->drop_table("users");
  }
}
?>
<?php
class PackageMigration extends Migration {
  public function up() {
    $t = $this->create_table("packages");
    $t->string('name');
    $t->belongs_to('user');
    $t->timestamps();
    $t->belongs_to('category');
    $t->go();
  }
  public function down() {
    $this->drop_table("packages");
    $this->drop_table('category_packages');
  }
}
?>
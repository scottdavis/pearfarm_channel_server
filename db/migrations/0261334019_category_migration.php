<?php
class CategoryMigration extends Migration {
  public function up() {
    $t = $this->create_table("categories");
    $t->string('name');
    $t->text('description');
    $t->timestamps();
    $t->go();
  }
  public function down() {
    $this->drop_table("categories");
  }
}
?>
<?php
/**
 * This class handles your request errors
 * customize each function to display your error pages.
 */
class r404 {
	
	public static function show_error_page() {
		echo file_get_contents(__DIR__ . '/../view/layout/error.html');
	}
	
	
  public static function GET() {
	var_dump('HERE');
		static::show_error_page();
  }
  public static function PUT() {
		static::show_error_page();
  }
  public static function DELETE() {
		static::show_error_page();
  }
  public static function POST() {
		static::show_error_page();
  }
  public static function HEAD() {
		static::show_error_page();
  }
}
?>
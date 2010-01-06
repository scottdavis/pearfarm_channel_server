<?php
/**
 * This class handles your request errors
 * customize each function to display your error pages.
 */
class r404 {
	
	public static function show_error_page() {
		return file_get_contents(__DIR__ . '/../app/view/layout/error.html');
	}
	
	
  public static function GET() {
	var_dump(static::show_error_page());
		echo static::show_error_page();
  }
  public static function PUT() {
		echo static::show_error_page();
  }
  public static function DELETE() {
		echo static::show_error_page();
  }
  public static function POST() {
		echo static::show_error_page();
  }
  public static function HEAD() {
		echo static::show_error_page();
  }
}
?>
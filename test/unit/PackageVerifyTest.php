<?php
require_once ('nimblize/nimble_test/lib/phpunit_testcase.php');
class PackageVerifyTest extends NimbleUnitTestCase {
  
  
  public function testPkiVerify() {
    $key = file_get_contents('file://' . getenv('HOME') . '/.ssh/id_openssl.pub');
    $file = "./bobs_other_package-0.0.1.tgz";
    copy(__DIR__ . '/../data/bobs_other_package-0.0.1.tgz', $file);
    $sig = static::calculatePackageSignature($file);
    $this->assertTrue(Package::verify($file, $sig, $key));
    unlink($file);
  }
  
  public static function calculatePackageSignature($file) {
      $keyfile = 'file://' . getenv('HOME') . '/.ssh/id_rsa';
      $key = openssl_pkey_get_private($keyfile);
      if($key === false){ throw new Exception("Keyfile at {$keyfile} didn't work: " . openssl_error_string());}
      $signature = NULL;
      $ok = openssl_sign(sha1_file($file, true), $signature , $key, OPENSSL_ALGO_SHA1);
      $signatureBase64 = base64_encode($signature);
      return $signatureBase64;
    }
  
}
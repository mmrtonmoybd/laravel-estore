<?php
namespace App\Traits;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

Trait CryptTrait {
   private $value;
   
   private function setavalue($value) {
      $this->value = $value;
      return $this->value;
   }
   public function encrypt($value) {
      $this->setavalue($value);
      return Crypt::encryptString($this->value);
   }
   
   public function deCrypt($value) {
      $this->setavalue($value);
      try {
	      return Crypt::decryptString($this->value);
	   } catch (DecryptException $e) {
	      echo "Unable to decrypt this hash: " . $e;
	   } 
   }
}
?>
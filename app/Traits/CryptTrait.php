<?php
namespace App\Traits;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

Trait CryptTrait {
   private $valuet;
   
   private function setavalue($valuet) {
      $this->valuet = $valuet;
      return $this->valuet;
   }
   public function encrypt($valuet) {
      $this->setavalue($valuet);
      return Crypt::encryptString($this->valuet);
   }
   
   public function deCrypt($valuet) {
      $this->setavalue($valuet);
      try {
	      return Crypt::decryptString($this->valuet);
	   } catch (DecryptException $e) {
	      echo "Unable to decrypt this hash: ";
	   } 
   }
}
?>
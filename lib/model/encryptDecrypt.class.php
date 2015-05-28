<?php

class encryptDecrypt{
   private $k;
   function __construct($m) {
      $this->k = $m;
    } 
   public function ed($t) { 
      $r = md5($this->k);
      $c=0; 
      $v = ""; 
      for ($i=0;$i<strlen($t);$i++) { 
         if ($c==strlen($r)) $c=0; 
         $v.= substr($t,$i,1) ^ substr($r,$c,1); 
         $c++; 
      } 
      return $v; 
   } 
   public function crypt($t){ 
      srand((double)microtime()*1000000);
      $r = md5(rand(0,32000));
      $c=0;
      $v = "";
      for ($i=0;$i<strlen($t);$i++){
         if ($c==strlen($r)) $c=0;
         $v.= substr($r,$c,1) . 
             (substr($t,$i,1) ^ substr($r,$c,1));
         $c++;
      } 
      return base64_encode($this->ed($v));
   } 
   public function decrypt($t) {
      $t = $this->ed(base64_decode($t));
      $v = "";
      for ($i=0;$i<strlen($t);$i++){
         $md5 = substr($t,$i,1);
         $i++;
         $v.= (substr($t,$i,1) ^ $md5);
      }
      return $v;
   }
}
?>
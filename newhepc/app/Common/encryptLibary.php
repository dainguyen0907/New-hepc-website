<?php 
namespace App\Common;
class encryptLibary{
    public $cipher_algo;
    public $passphrase;
    public $options;
    public $iv;
    public function __construct(){
        $this->cipher_algo="AES-128-CTR";
        $this->passphrase="hepc";
        $this->options=0;
        $this->iv=substr(hash('sha256',"554hahuygiap"),0,16);
    }
    public function getEncryptLibary()
    {
        return [
            "cipher_algo"=>$this->cipher_algo,
            "passphrase"=>$this->passphrase,
            "options"=>$this->options,
            "iv"=>$this->iv
        ];
    }
}
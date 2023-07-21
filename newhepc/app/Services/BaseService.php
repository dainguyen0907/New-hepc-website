<?php
namespace App\Services;

class BaseService{

    public $validation;
    function __construct()
    {
        $this->validation=\config\Services::validation();
    }
}
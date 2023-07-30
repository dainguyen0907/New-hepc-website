<?php
namespace App\Services;
use App\Models\userModel;


class admin_userService extends BaseService
{
    private $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel=new userModel();
    }
    public function getAllUser()
    {
        return $this->userModel->join('phanquyen','phanquyen.id_q=user.id_q','left')->findAll();
    }
    

}
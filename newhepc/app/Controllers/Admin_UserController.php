<?php

namespace App\Controllers;
use App\Common\libary;
use App\Services\admin_userService;


class Admin_UserController extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel=new admin_userService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Tài khoản";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables];
        $page = 'adminPage/pages/userPage';
        $dataLayout['Users']=$this->userModel->getAllUser();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

}
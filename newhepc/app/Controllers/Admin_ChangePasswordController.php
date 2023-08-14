<?php

namespace App\Controllers;
use App\Common\encryptLibary;
use App\Common\libary;
use App\Services\admin_cmphongbanService;
use App\Services\admin_phongbanService;
use App\Services\admin_userService;



class Admin_ChangePasswordController extends BaseController
{
    private $userService;
    public function __construct()
    {
        $this->userService= new admin_userService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Đổi mật khẩu";
        $cssLib = [];
        $jsLib = [];
        $page = 'adminPage/pages/changePasswordPage';
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, [], $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }
    public function changePassword()
    {
        $res=$this->userService->changePassword($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    
}
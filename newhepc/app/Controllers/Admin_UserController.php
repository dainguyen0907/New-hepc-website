<?php

namespace App\Controllers;
use App\Common\encryptLibary;
use App\Common\libary;
use App\Common\ResultUtils;
use App\Services\admin_phanquyenService;
use App\Services\admin_phongbanService;
use App\Services\admin_userService;


class Admin_UserController extends BaseController
{
    private $userService;
    private $phongbanService;
    private $phanquyenService;
    private $encrypt;
    public function __construct()
    {
        $this->userService=new admin_userService();
        $this->phongbanService= new admin_phongbanService();
        $this->phanquyenService=new admin_phanquyenService();
        $this->encrypt=new encryptLibary();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Tài khoản";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables,"assets/js/modal.js"];
        $page = 'adminPage/pages/userPage';
        $dataLayout['Users']=$this->userService->getAllUser();
        $dataLayout['encrypt']=$this->encrypt->getEncryptLibary();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }
    public function addPage()
    {
        $masterPage = [];
        $title = "Tài khoản";
        $cssLib = [];
        $jsLib = [];
        $page = 'adminPage/pages/userPage-add';
        $dataLayout['pb']=$this->phongbanService->getAllPhongBan();
        $dataLayout['pq']=$this->phanquyenService->getAllphanquyen();
        $dataLayout['title']="Thêm tài khoản mới";
        $dataLayout['mode']="add";
        $dataLayout['action']="admin/management/user/add";
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }
    public function changePage($id_user)
    {
        $user=$this->userService->getUserInfo($id_user);
        if($user!=null)
        {
            $masterPage = [];
            $title = "Tài khoản";
            $cssLib = [];
            $jsLib = [];
            $page = 'adminPage/pages/userPage-add';
            $dataLayout['pb']=$this->phongbanService->getAllPhongBan();
            $dataLayout['pq']=$this->phanquyenService->getAllphanquyen();
            $dataLayout['title']="Cập nhật tài khoản";
            $dataLayout['mode']="change";
            $dataLayout['action']="admin/management/user/change";
            $dataLayout['user']=$user;
            $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
            return view('adminPage/masterPage', $AdmissionPage);
        }
        return $this->load404page();
        
    }
    public function resetPassword()
    {
        $res=$this->userService->resetPassword($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function createUser()
    {
        $res=$this->userService->createUser($this->request);
        if($res['status']===ResultUtils::STATUS_CODE_OK)
        {
            return redirect()->to('admin/management/user')->withInput()->with($res['messageCode'],$res['message']);
        }
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    public function updateUser()
    {
        $res=$this->userService->updateUser($this->request);
        if($res['status']===ResultUtils::STATUS_CODE_OK)
        {
            return redirect()->to('admin/management/user')->withInput()->with($res['messageCode'],$res['message']);
        }
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function deleteUser()
    {
        $res=$this->userService->deleteUser($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

}
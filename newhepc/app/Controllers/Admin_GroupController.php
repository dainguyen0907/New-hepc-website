<?php

namespace App\Controllers;
use App\Common\libary;
use App\Common\ResultUtils;
use App\Services\admin_phongbanService;


class Admin_GroupController extends BaseController
{
    private $phongbanService;
    public function __construct()
    {
        $this->phongbanService= new admin_phongbanService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Tài khoản";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables];
        $page = 'adminPage/pages/groupPage';
        $dataLayout['groups']=$this->phongbanService->getAllPhongBan();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function change_status($id)
    {
        $res=$this->phongbanService->updateStatusByID($id);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    public function deleteGroup()
    {
        $res=$this->phongbanService->deletePhongBan($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function addGroup()
    {
        $res=$this->phongbanService->addGroup($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

}
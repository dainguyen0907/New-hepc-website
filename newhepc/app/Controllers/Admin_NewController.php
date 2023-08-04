<?php

namespace App\Controllers;
use App\Common\libary;
use App\Services\admin_baivietService;
use App\Services\admin_phongbanService;


class Admin_NewController extends BaseController
{
    private $baivietService;
    private $phongbanService;
    public function __construct()
    {
        $this->baivietService= new admin_baivietService();
        $this->phongbanService=new admin_phongbanService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Trang chủ";
        $page = 'adminPage/Pages/newpaperPage';
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables,'assets/js/ajax.js'];
        $dataLayout['news']=$this->baivietService->getAllNews();
        $dataLayout['groups']=$this->phongbanService->getAllPhongBan();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }
    public function loadEditPageAdmin()
    {
        $masterPage = [];
        $title = "Chỉnh sửa";
        $page = 'adminPage/Pages/editPage';
        $jsLib = ["assets/js/ckeditor.js","assets/js/loadckeditor.js"];
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, [], [], $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function loadDataTableById_pb()
    {
        return $this->baivietService->loadHTMLTableById_pb($this->request->getPost()['id_pb']);
    }

}
<?php

namespace App\Controllers;
use App\Common\libary;
use App\Common\ResultUtils;
use App\Services\admin_anhService;
use App\Services\admin_phongbanService;



class Admin_PictureController extends BaseController
{
    private $pictureService;
    private $groupService;
    public function __construct()
    {
        $this->pictureService= new admin_anhService();
        $this->groupService=new admin_phongbanService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Ảnh hoạt động";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables];
        $page = 'adminPage/pages/picturePage';
        $dataLayout['pictures']=$this->pictureService->getAllPicture();
        $dataLayout['Groups']=$this->groupService->getAllPhongBan();
        $dataLayout['role']='admin';
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function deletePicture()
    {
        $res=$this->pictureService->deletePicture($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function updatePicture()
    {
        $res=$this->pictureService->updatePicture($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function addPicture()
    {
        $res=$this->pictureService->addPicture($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function loadMyPicturePage(){
        $masterPage = [];
        $title = "Ảnh cá nhân";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables];
        $page = 'adminPage/pages/picturePage';
        $dataLayout['pictures']=$this->pictureService->getPictureById_user(session('userLogin')['id_user']);
        $dataLayout['Groups']=$this->groupService->getAllPhongBan();
        $dataLayout['role']='user';
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function loadGroupPicturePage(){
        $masterPage = [];
        $title = "Ảnh phòng ban";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables];
        $page = 'adminPage/pages/picturePage';
        $dataLayout['role']='leader';
        $dataLayout['pictures']=$this->pictureService->getPictureById_pb(session('userLogin')['id_pb']);
        $dataLayout['Groups']=$this->groupService->getAllPhongBan();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function loadCensorPicturePage(){
        $masterPage = [];
        $title = "Ảnh phòng ban";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables];
        $page = 'adminPage/pages/picturePage';
        $dataLayout['role']='leader';
        $dataLayout['pictures']=$this->pictureService->getCountCensorPicture(session('userLogin')['id_pb']);
        $dataLayout['Groups']=$this->groupService->getAllPhongBan();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    
    
}
<?php

namespace App\Controllers;
use App\Common\libary;
use App\Common\ResultUtils;
use App\Services\admin_videoService;



class Admin_VideoController extends BaseController
{
    private $videoService;
    public function __construct()
    {
        $this->videoService= new admin_videoService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Video";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables];
        $page = 'adminPage/pages/videoPage';
        $dataLayout['videos']=$this->videoService->getAllvideo();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }
    public function addVideo()
    {
        $res=$this->videoService->addVideo($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    public function deleteVideo()
    {
        $res=$this->videoService->deleteVideo($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    public function updateVideoPage($id)
    {
        $data=$this->videoService->getVideoById($id);
        if($data==null){
            return $this->load404page();
        }
        $masterPage = [];
        $title = "Video";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables];
        $page = 'adminPage/pages/videoPage-update';
        $dataLayout['title']="Cập nhật video";
        $dataLayout['video']=$data;
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function updateVideo()
    {
        $res=$this->videoService->updateVideo($this->request);
        if($res['status']===ResultUtils::STATUS_CODE_OK)
        {
            return redirect()->to('admin/management/video')->withInput()->with($res['messageCode'],$res['message']);
        }
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    
    
}
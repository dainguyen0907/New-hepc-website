<?php

namespace App\Controllers;
use App\Common\libary;
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

    
    
}
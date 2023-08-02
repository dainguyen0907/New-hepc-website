<?php

namespace App\Controllers;
use App\Common\libary;
use App\Services\admin_bannerService;



class Admin_BannerController extends BaseController
{
    private $bannerService;
    public function __construct()
    {
        $this->bannerService= new admin_bannerService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Banner Quảng cáo";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables];
        $page = 'adminPage/pages/bannerPage';
        $dataLayout['banners']=$this->bannerService->getAllBanner();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }

    public function addBanner()
    {
        $res=$this->bannerService->addBanner($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function updateBanner()
    {
        $res=$this->bannerService->updateBanner($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }

    public function deleteBanner()
    {
        $res=$this->bannerService->deleteBanner($this->request);
        return redirect()->back()->withInput()->with($res['messageCode'],$res['message']);
    }
    
}
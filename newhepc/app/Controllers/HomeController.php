<?php

namespace App\Controllers;

use App\Services\baivietService;
use App\Services\bannerService;
use App\Services\videoService;

class HomeController extends BaseController
{
    private $baivietService;
    private $bannerService;
    private $videoService;

    public function __construct() {
        $this->baivietService=new baivietService();
        $this->bannerService=new bannerService();
        $this->videoService=new videoService();
    }
    public function index()
    {
        $masterPage=[];
        $title="HEPC";
        $page='publicPage/pages/home';
        $dataLayout['Banners']=$this->bannerService->getBannersForHomePage();
        $dataLayout['News']=$this->baivietService->getNewsforOfficePage(131);
        $dataLayout['Anouncements']=$this->baivietService->getNewsforOfficePage(96);
        $dataLayout['Admissions']=$this->baivietService->getAdmissionsForHomePage();
        $dataLayout['Recruitments']=$this->baivietService->getNewsforOfficePage(137);
        $dataLayout['Videos']=$this->videoService->getVideosForHomePage();
        $homePage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('publicPage/masterPage',$homePage);
    }
}

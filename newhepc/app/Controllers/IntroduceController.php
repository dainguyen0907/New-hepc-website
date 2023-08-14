<?php

namespace App\Controllers;

use App\Services\baivietService;

class IntroduceController extends BaseController
{
    private $baivietService;
    private $bannerService;
    private $videoService;

    public function __construct() {
        $this->baivietService=new baivietService();
    }
    public function showIntroduce($link)
    {
        $detail=$this->baivietService->getNewDetail(92,$link);
        $masterPage=[];
        $page='publicPage/pages/introducePage';
        $dataLayout['Banner']="Giới thiệu";
        $dataLayout['detail']=$detail;
        $dataLayout['introduces']=$this->baivietService->getAllIntroduce();
        return $this->checkPageExits($detail,$page,$dataLayout);
    }
}

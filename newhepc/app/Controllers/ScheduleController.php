<?php

namespace App\Controllers;

use App\Services\baivietService;

class ScheduleController extends BaseController
{
    private $baivietService;

    public function __construct() {
        $this->baivietService=new baivietService();
    }
    public function index()
    {
        $masterPage=[];
        $title="Lịch thi";
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Lịch thi";
        $dataLayout['content']=view('publicPage/pages/newsPage',['News'=>$this->baivietService->getNewForPage(134),'link'=>"lich-thi"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $schedulePage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('publicPage/masterPage',$schedulePage);
    }

    public function getScheduleDetail($link)
    {
        $newdetail=$this->baivietService->getNewDetail(134,$link);
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Lịch thi";
        $dataLayout['content']=view('publicPage/pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreNew(134,$link),'link'=>"lich-thi"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

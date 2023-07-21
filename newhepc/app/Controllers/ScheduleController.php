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
        $page='subMasterPage';
        $dataLayout['Banner']="Lịch thi";
        $dataLayout['content']=view('pages/newsPage',['News'=>$this->baivietService->getScheduleForSchedulePage(),'link'=>"lich-thi"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $schedulePage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$schedulePage);
    }

    public function getScheduleDetail($link)
    {
        $newdetail=$this->baivietService->getScheduleDetail($link);
        $page='subMasterPage';
        $dataLayout['Banner']="Lịch thi";
        $dataLayout['content']=view('pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreSchedule($link),'link'=>"lich-thi"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

<?php

namespace App\Controllers;

use App\Services\baivietService;

class TimeTableController extends BaseController
{
    private $baivietService;

    public function __construct() {
        $this->baivietService=new baivietService();
    }
    public function index()
    {
        $masterPage=[];
        $title="Thời khóa biểu";
        $page='subMasterPage';
        $dataLayout['Banner']="Thời khóa biểu";
        $dataLayout['content']=view('pages/newsPage',['News'=>$this->baivietService->getTimeTableForTBPage(),'link'=>"thoi-khoa-bieu"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $timeTablePage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$timeTablePage);
    }

    public function getTimeTableDetail($link)
    {
        $newdetail=$this->baivietService->getTimeTableDetail($link);
        $page='subMasterPage';
        $dataLayout['Banner']="Thời khóa biểu";
        $dataLayout['content']=view('pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreTimeTable($link),'link'=>"thoi-khoa-bieu"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

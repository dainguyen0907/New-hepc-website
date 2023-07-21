<?php

namespace App\Controllers;

use App\Services\baivietService;

class AnouncementController extends BaseController
{
    private $baivietService;

    public function __construct() {
        $this->baivietService=new baivietService();
    }
    public function index()
    {
        $masterPage=[];
        $title="Thông báo";
        $page='subMasterPage';
        $dataLayout['Banner']="Thông báo";
        $dataLayout['content']=view('pages/newsPage',['News'=>$this->baivietService->getAnouncementForAnouncementPage(),'link'=>'thong-bao']);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $AnouncementPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$AnouncementPage);
    }

    public function getAnouncementDetail($link)
    {
        $newdetail=$this->baivietService->getTimeTableDetail($link);
        $page='subMasterPage';
        $dataLayout['Banner']="Thông báo";
        $dataLayout['content']=view('pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreAnouncement($link),'link'=>"thong-bao"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

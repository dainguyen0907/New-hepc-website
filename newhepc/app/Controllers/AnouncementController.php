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
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Thông báo";
        $dataLayout['content']=view('publicPage/pages/newsPage',['News'=>$this->baivietService->getNewForPage(96),'link'=>'thong-bao']);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $AnouncementPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('publicPage/masterPage',$AnouncementPage);
    }

    public function getAnouncementDetail($link)
    {
        $newdetail=$this->baivietService->getNewDetail(96,$link);
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Thông báo";
        $dataLayout['content']=view('publicPage/pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreNew(96,$link),'link'=>"thong-bao"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

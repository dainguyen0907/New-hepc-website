<?php

namespace App\Controllers;

use App\Services\baivietService;

class NewPaperController extends BaseController
{
    private $baivietService;

    public function __construct() {
        $this->baivietService=new baivietService();
    }
    public function index()
    {
        $masterPage=[];
        $title="Tin tức";
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Tin tức";
        $dataLayout['content']=view('publicPage/pages/newsPage',['News'=>$this->baivietService->getNewForPage(131),'link'=>'tin-tuc']);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $NewPaperPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('publicPage/masterPage',$NewPaperPage);
    }

    public function getNewPaperDetail($link)
    {
        $newdetail=$this->baivietService->getNewDetail(131,$link);
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Tin tức";
        $dataLayout['content']=view('publicPage/pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreNew(131,$link),'link'=>"tin-tuc"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

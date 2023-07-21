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
        $page='subMasterPage';
        $dataLayout['Banner']="Tin tức";
        $dataLayout['content']=view('pages/newsPage',['News'=>$this->baivietService->getNewsForNewPaperPage(),'link'=>'tin-tuc']);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $NewPaperPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$NewPaperPage);
    }

    public function getNewPaperDetail($link)
    {
        $newdetail=$this->baivietService->getNewPaperDetail($link);
        $page='subMasterPage';
        $dataLayout['Banner']="Tin tức";
        $dataLayout['content']=view('pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreNewPaper($link),'link'=>"tin-tuc"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

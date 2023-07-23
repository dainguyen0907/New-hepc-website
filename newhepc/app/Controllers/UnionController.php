<?php

namespace App\Controllers;

use App\Services\baivietService;

class UnionController extends BaseController
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
        $dataLayout['content']=view('pages/newsPage',['News'=>$this->baivietService->getUnionForUnionPage(),'link'=>"cong-doan"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $UnionPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$UnionPage);
    }

    public function getUnionDetail($link)
    {
        $newdetail=$this->baivietService->getUnionDetail($link);
        $page='subMasterPage';
        $dataLayout['Banner']="Lịch thi";
        $dataLayout['content']=view('pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreUnion($link),'link'=>"cong-doan"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class UnionController extends BaseController
{
    private $baivietService;
    private $cmpbService;

    public function __construct() {
        $this->baivietService=new baivietService();
        $this->cmpbService=new cmphongbanService();
    }
    public function index()
    {
        $masterPage=[];
        $title="Công đoàn";
        $page='subMasterPage';
        $dataLayout['Banner']="Công đoàn";
        $dataLayout['content']=view('pages/newsPage',['News'=>$this->baivietService->getUnionForUnionPage(),'link'=>"cong-doan"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('layouts/rightMenuForOffice',['Newest'=>$this->baivietService->getAnouncementForRightMenu(),'catalogues'=>$this->cmpbService->getCatalogues(16)]);
        $UnionPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$UnionPage);
    }

    public function getUnionDetail($link)
    {
        $newdetail=$this->baivietService->getUnionDetail($link);
        $page='subMasterPage';
        $dataLayout['Banner']="Công đoàn";
        $dataLayout['content']=view('pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreUnion($link),'link'=>"cong-doan"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

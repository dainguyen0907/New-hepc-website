<?php

namespace App\Controllers;

use App\Services\baivietService;

class CommitmentController extends BaseController
{
    private $baivietService;

    public function __construct() {
        $this->baivietService=new baivietService();
    }
    public function index()
    {
        $masterPage=[];
        $title="Ba công khai";
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Ba công khai";
        $dataLayout['content']=view('publicPage/pages/newsPage',['News'=>$this->baivietService->getNewForPage(136),'link'=>"ba-cong-khai"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $commitmentPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('publicPage/masterPage',$commitmentPage);
    }

    public function getCommitmentDetail($link)
    {
        $newdetail=$this->baivietService->getNewDetail(136,$link);
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Ba công khai";
        $dataLayout['content']=view('publicPage/pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreNew(136,$link),'link'=>"ba-cong-khai"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

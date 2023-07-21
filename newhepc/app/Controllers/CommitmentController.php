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
        $page='subMasterPage';
        $dataLayout['Banner']="Ba công khai";
        $dataLayout['content']=view('pages/newsPage',['News'=>$this->baivietService->getCommitmentForCommitmentPage(),'link'=>"ba-cong-khai"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $commitmentPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$commitmentPage);
    }

    public function getCommitmentDetail($link)
    {
        $newdetail=$this->baivietService->getCommitmentDetail($link);
        $page='subMasterPage';
        $dataLayout['Banner']="Ba công khai";
        $dataLayout['content']=view('pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreCommitment($link),'link'=>"ba-cong-khai"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

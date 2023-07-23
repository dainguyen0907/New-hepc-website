<?php

namespace App\Controllers;

use App\Services\baivietService;

class RecruitmentController extends BaseController
{
    private $baivietService;

    public function __construct() {
        $this->baivietService=new baivietService();
    }
    public function index()
    {
        $masterPage=[];
        $title="Tuyển dụng";
        $page='subMasterPage';
        $dataLayout['Banner']="Tuyển dụng";
        $dataLayout['content']=view('pages/newsPage',['News'=>$this->baivietService->getRecruitmentForRecruitmentPage(),'link'=>'tuyen-dung']);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $RecruitmentPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$RecruitmentPage);
    }

    public function getRecruitmentDetail($link)
    {
        $newdetail=$this->baivietService->getRecruitmentDetail($link);
        $page='subMasterPage';
        $dataLayout['Banner']="Tuyển dụng";
        $dataLayout['content']=view('pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreRecruitment($link),'link'=>"tuyen-dung"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

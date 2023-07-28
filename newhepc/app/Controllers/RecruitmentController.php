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
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Tuyển dụng";
        $dataLayout['content']=view('publicPage/pages/newsPage',['News'=>$this->baivietService->getRecruitmentForRecruitmentPage(),'link'=>'tuyen-dung']);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $RecruitmentPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('publicPage/masterPage',$RecruitmentPage);
    }

    public function getRecruitmentDetail($link)
    {
        $newdetail=$this->baivietService->getRecruitmentDetail($link);
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Tuyển dụng";
        $dataLayout['content']=view('publicPage/pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreRecruitment($link),'link'=>"tuyen-dung"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

<?php

namespace App\Controllers;

use App\Services\baivietService;

class AdmissionController extends BaseController
{
    private $baivietService;

    public function __construct() {
        $this->baivietService=new baivietService();
    }
    public function index()
    {
        $masterPage=[];
        $title="Tuyển sinh";
        $page='subMasterPage';
        $dataLayout['Banner']="Tuyển sinh";
        $dataLayout['content']=view('pages/newsPage',['News'=>$this->baivietService->getAdmissionForAdmissionPage(),'link'=>'tuyen-sinh']);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $AdmissionPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$AdmissionPage);
    }

    public function getAdmissionDetail($link)
    {
        $newdetail=$this->baivietService->getAdmissionDetail($link);
        $page='subMasterPage';
        $dataLayout['Banner']="Tuyển sinh";
        $dataLayout['content']=view('pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreAdmission($link),'link'=>"tuyen-sinh"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

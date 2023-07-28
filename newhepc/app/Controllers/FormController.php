<?php

namespace App\Controllers;

use App\Services\baivietService;

class FormController extends BaseController
{
    private $baivietService;

    public function __construct() {
        $this->baivietService=new baivietService();
    }
    public function index()
    {
        $masterPage=[];
        $title="Biểu mẫu";
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Biểu mẫu";
        $dataLayout['content']=view('publicPage/pages/newsPage',['News'=>$this->baivietService->getFormForFormPage(),'link'=>"bieu-mau"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $formPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('publicPage/masterPage',$formPage);
    }

    public function getFormDetail($link)
    {
        $newdetail=$this->baivietService->getFormDetail($link);
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Biểu mẫu";
        $dataLayout['content']=view('publicPage/pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreForm($link),'link'=>"bieu-mau"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

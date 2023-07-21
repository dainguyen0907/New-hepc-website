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
        $page='subMasterPage';
        $dataLayout['Banner']="Biểu mẫu";
        $dataLayout['content']=view('pages/newsPage',['News'=>$this->baivietService->getFormForFormPage(),'link'=>"bieu-mau"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $formPage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('masterPage',$formPage);
    }

    public function getFormDetail($link)
    {
        $newdetail=$this->baivietService->getFormDetail($link);
        $page='subMasterPage';
        $dataLayout['Banner']="Biểu mẫu";
        $dataLayout['content']=view('pages/newDetail',['New'=>$newdetail, 'More'=>$this->baivietService->getMoreForm($link),'link'=>"bieu-mau"]);
        $dataLayout['Pager']=null;
        $dataLayout['rightBanner']=view('layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail,$page,$dataLayout);
    }
}

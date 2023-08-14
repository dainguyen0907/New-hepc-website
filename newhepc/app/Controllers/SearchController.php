<?php

namespace App\Controllers;

use App\Services\baivietService;

class SearchController extends BaseController
{
    private $baivietService;

    public function __construct() {
        $this->baivietService=new baivietService();
    }
    public function index()
    {
        $masterPage=[];
        $title="Tìm kiếm";
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Tìm kiếm";
        $dataLayout['content']=view('publicPage/pages/searchPage',['News'=>$this->baivietService->getNewForPage(131),'link'=>"ket-qua"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $schedulePage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('publicPage/masterPage',$schedulePage);
    }

    public function loadSearchPage($link)
    {
        $key_word=$this->convertLinkToString($link);
        $News=$this->baivietService->searchNewByKeyWord($key_word);
        $masterPage=[];
        $title="Tìm kiếm";
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Tìm kiếm";
        $dataLayout['content']=view('publicPage/pages/searchPage',['News'=>$News,'link'=>"ket-qua",'count'=>count($News),'key_word'=>$key_word]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $schedulePage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('publicPage/masterPage',$schedulePage);
    }

    public function loadDetailSearchPage($link)
    {
        $New=$this->baivietService->getNewDetailByLink($link);
        if($New==null)
            return $this->load404page();
        $masterPage=[];
        $title="Tìm kiếm";
        $page='publicPage/subMasterPage';
        $dataLayout['Banner']="Tìm kiếm";
        $dataLayout['content']=view('publicPage/pages/newDetail',['New'=>$New,'link'=>"ket-qua"]);
        $dataLayout['Pager']=$this->baivietService->getPager();
        $dataLayout['rightBanner']=view('publicPage/layouts/rightMenuForNew',['Newest'=>$this->baivietService->getAnouncementForRightMenu()]);
        $schedulePage=$this->loadLayout($masterPage,$title,$page,$dataLayout,[],[]);
        return view('publicPage/masterPage',$schedulePage);
    }

    
}

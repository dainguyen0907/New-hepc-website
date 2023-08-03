<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;
use App\Services\fileAnhService;

class NNTTController extends BaseController
{
    private $baivietService;
    private $cmpbService;
    private $anhService;

    public function __construct()
    {
        $this->baivietService = new baivietService();
        $this->cmpbService = new cmphongbanService();
        $this->anhService=new fileAnhService();
    }
    public function index()
    {
        $tintuc = $this->cmpbService->getCatalogueByID('87');
        $gioithieu = $this->cmpbService->getCatalogueByID('90');
        $masterPage = [];
        $title = "Trung tâm ngoại ngữ tin học";
        $page = 'publicPage/pages/officePage';
        $dataLayout['Banner'] = "Trung tâm ngoại ngữ tin học";
        $dataLayout['f_name_catalogue'] = $gioithieu['cmphongban'];
        $dataLayout['s_name_catalogue'] = $tintuc['cmphongban'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('90');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('87');
        $dataLayout['image'] = null;
        $dataLayout['album']=$this->anhService->getPicturesById_PB('14');
        $dataLayout['link'] = "phong-nn-tt/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueNNTT($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('14', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('14', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['cmphongban'];
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Trung tâm ngoại ngữ tin học";
            $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "phong-nn-tt"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(14), 'link' => "phong-nn-tt/"]);
            $NNTTPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('publicPage/masterPage', $NNTTPage);
        } else {
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Trung tâm ngoại ngữ tin học";
            $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('87', $link), 'link' => "phong-nn-tt"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(14), 'link' => "phong-nn-tt/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
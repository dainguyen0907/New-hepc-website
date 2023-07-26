<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class UnionController extends BaseController
{
    private $baivietService;
    private $cmpbService;

    public function __construct()
    {
        $this->baivietService = new baivietService();
        $this->cmpbService = new cmphongbanService();
    }
    public function index()
    {
        $tintuc=$this->cmpbService->getCatalogueByID('128');
        $gioithieu=$this->cmpbService->getCatalogueByID('127');
        $masterPage = [];
        $title = "Công đoàn";
        $page = 'pages/officePage';
        $dataLayout['Banner'] = "Công đoàn";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('127');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('128');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "cong-doan/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueUnion($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('16', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('16', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Công đoàn";
            $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "cong-doan"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(16), 'link' => "cong-doan/"]);
            $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('masterPage', $UnionPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Công đoàn";
            $dataLayout['content'] = view('pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('128', $link), 'link' => "cong-doan"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(16), 'link' => "cong-doan/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
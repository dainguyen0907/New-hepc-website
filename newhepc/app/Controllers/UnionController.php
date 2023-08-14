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
        $page = 'publicPage/pages/officePage';
        $dataLayout['Banner'] = "Công đoàn";
        $dataLayout['f_name_catalogue'] = $gioithieu['cmphongban'];
        $dataLayout['s_name_catalogue'] = $tintuc['cmphongban'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('127');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('128');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "cong-doan/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueUnion($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('16', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('16', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['cmphongban'];
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Công đoàn";
            $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForPage($catalogue['id_cmpb']), 'link' => "cong-doan"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(16), 'link' => "cong-doan/"]);
            $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('publicPage/masterPage', $UnionPage);
        } else {
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Công đoàn";
            $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('128', $link), 'link' => "cong-doan"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(16), 'link' => "cong-doan/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
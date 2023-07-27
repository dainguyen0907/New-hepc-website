<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class QLKHController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('63');
        $gioithieu = $this->cmpbService->getCatalogueByID('66');
        $masterPage = [];
        $title = "Phòng QLKH-QHQT";
        $page = 'pages/officePage';
        $dataLayout['Banner'] = "Phòng QLKH-QHQT";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('66');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('63');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "phong-qlkh";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueQLKH($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('10', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('10', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Phòng QLKH";
            $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "phong-qlkh"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(10), 'link' => "phong-qlkh/"]);
            $QLKHPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('masterPage', $QLKHPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Phòng QLKH";
            $dataLayout['content'] = view('pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('63', $link), 'link' => "phong-qlkh"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(10), 'link' => "phong-qlkh/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
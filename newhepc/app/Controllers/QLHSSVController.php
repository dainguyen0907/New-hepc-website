<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class QLHSSVController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('69');
        $gioithieu = $this->cmpbService->getCatalogueByID('72');
        $masterPage = [];
        $title = "Phòng quản lý học sinh sinh viên";
        $page = 'pages/officePage';
        $dataLayout['Banner'] = "Phòng quản lý học sinh sinh viên";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('72');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('69');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "phong-qlhssv/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueQLHSSV($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('11', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('11', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Phòng quản lý học sinh sinh viên";
            $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "phong-qlhssv"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(11), 'link' => "phong-qlhssv/"]);
            $QLHSSVPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('masterPage', $QLHSSVPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Phòng quản lý học sinh sinh viên";
            $dataLayout['content'] = view('pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('69', $link), 'link' => "phong-qlhssv"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(11), 'link' => "phong-qlhssv/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class KHCBKTController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('27');
        $gioithieu = $this->cmpbService->getCatalogueByID('23');
        $masterPage = [];
        $title = "Khoa học cơ bản - kinh tế";
        $page = 'pages/officePage';
        $dataLayout['Banner'] = "Khoa học cơ bản - kinh tế";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('23');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('27');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "khoa-khcb-kt";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueKHCBKT($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('4', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('4', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Khoa học cơ bản - kinh tế";
            $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "khoa-khcb-kt"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(4), 'link' => "khoa-khcb-kt/"]);
            $KHCBKTPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('masterPage', $KHCBKTPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Khoa học cơ bản - kinh tế";
            $dataLayout['content'] = view('pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('23', $link), 'link' => "khoa-khcb-kt"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(4), 'link' => "khoa-khcb-kt/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
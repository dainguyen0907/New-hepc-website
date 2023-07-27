<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class HTDController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('5');
        $gioithieu = $this->cmpbService->getCatalogueByID('2');
        $masterPage = [];
        $title = "Khoa hệ thống điện";
        $page = 'pages/officePage';
        $dataLayout['Banner'] = "Khoa hệ thống điện";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('2');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('5');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "khoa-htd/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueHTD($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('1', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('1', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Khoa hệ thống điện";
            $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "khoa-htd"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(1), 'link' => "khoa-htd/"]);
            $HTDPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('masterPage', $HTDPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Khoa hệ thống điện";
            $dataLayout['content'] = view('pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('2', $link), 'link' => "khoa-htd"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(1), 'link' => "khoa-htd/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
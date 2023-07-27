<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class KTCSController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('12');
        $gioithieu = $this->cmpbService->getCatalogueByID('9');
        $masterPage = [];
        $title = "Khoa Kỹ thuật cơ sở";
        $page = 'pages/officePage';
        $dataLayout['Banner'] = "Khoa Kỹ thuật cơ sở";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('9');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('12');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "khoa-ktcs/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueKTCS($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('2', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('2', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Khoa Kỹ thuật cơ sở";
            $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "khoa-ktcs"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(2), 'link' => "khoa-ktcs/"]);
            $KTCSPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('masterPage', $KTCSPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Khoa Kỹ thuật cơ sở";
            $dataLayout['content'] = view('pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('9', $link), 'link' => "khoa-ktcs"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(2), 'link' => "khoa-ktcs/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
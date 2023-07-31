<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class QTController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('79');
        $gioithieu = $this->cmpbService->getCatalogueByID('78');
        $masterPage = [];
        $title = "Phòng quản trị";
        $page = 'publicPage/pages/officePage';
        $dataLayout['Banner'] = "Phòng quản trị";
        $dataLayout['f_name_catalogue'] = $gioithieu['cmphongban'];
        $dataLayout['s_name_catalogue'] = $tintuc['cmphongban'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('78');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('79');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "phong-quan-tri/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueQT($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('12', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('12', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['cmphongban'];
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Phòng QT";
            $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "phong-quan-tri"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(12), 'link' => "phong-quan-tri/"]);
            $QTPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('publicPage/masterPage', $QTPage);
        } else {
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Phòng QT";
            $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('75', $link), 'link' => "phong-quan-tri"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(12), 'link' => "phong-quan-tri/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
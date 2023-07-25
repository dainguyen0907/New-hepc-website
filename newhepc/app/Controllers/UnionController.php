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
        $masterPage = [];
        $title = "Công đoàn";
        $page = 'subMasterPage';
        $dataLayout['Banner'] = "Công đoàn";
        $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForPage('128'), 'link' => "cong-doan/"]);
        $dataLayout['Pager'] = $this->baivietService->getPager();
        $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(16)]);
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
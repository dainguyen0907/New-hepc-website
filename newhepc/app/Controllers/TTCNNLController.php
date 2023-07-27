<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class TTCNNLController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('84');
        $gioithieu = $this->cmpbService->getCatalogueByID('80');
        $masterPage = [];
        $title = "Trung tâm công nghệ năng lượng";
        $page = 'pages/officePage';
        $dataLayout['Banner'] = "Trung tâm công nghệ năng lượng";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('80');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('84');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "phong-tt-nangluong";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueTTCNNL($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('13', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('13', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Trung tâm công nghệ năng lượng";
            $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "phong-tt-nangluong"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(13), 'link' => "phong-tt-nangluong/"]);
            $TTCNNLPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('masterPage', $TTCNNLPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Trung tâm công nghệ năng lượng";
            $dataLayout['content'] = view('pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('81', $link), 'link' => "phong-tt-nangluong"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(13), 'link' => "phong-tt-nangluong/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
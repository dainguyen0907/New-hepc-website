<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class DCNController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('19');
        $gioithieu = $this->cmpbService->getCatalogueByID('16');
        $masterPage = [];
        $title = "Khoa điện công nghiệp";
        $page = 'pages/officePage';
        $dataLayout['Banner'] = "Khoa điện công nghiệp";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('16');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('19');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "khoa-dcn/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueDCN($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('3', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('3', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Khoa điện công nghiệp";
            $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "khoa-dcn"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(3), 'link' => "khoa-dcn/"]);
            $DCNPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('masterPage', $DCNPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Khoa điện công nghiệp";
            $dataLayout['content'] = view('pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('16', $link), 'link' => "khoa-dcn"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(3), 'link' => "khoa-dcn/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
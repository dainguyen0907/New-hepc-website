<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class DTController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('45');
        $gioithieu = $this->cmpbService->getCatalogueByID('48');
        $masterPage = [];
        $title = "Phòng đào tạo";
        $page = 'publicPage/pages/officePage';
        $dataLayout['Banner'] = "Phòng đào tạo";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('48');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('45');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "phong-dao-tao/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueDT($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('7', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('7', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Phòng đào tạo";
            $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "phong-dao-tao"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(7), 'link' => "phong-dao-tao/"]);
            $DTPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('publicPage/masterPage', $DTPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Phòng đào tạo";
            $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('45', $link), 'link' => "phong-dao-tao"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(7), 'link' => "phong-dao-tao/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
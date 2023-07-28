<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class DTNCController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('38');
        $gioithieu = $this->cmpbService->getCatalogueByID('41');
        $masterPage = [];
        $title = "Khoa đào tạo nâng cao";
        $page = 'publicPage/pages/officePage';
        $dataLayout['Banner'] = "Khoa đào tạo nâng cao";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('41');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('38');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "khoa-dtnc/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueDTNC($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('6', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('6', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Khoa đào tạo nâng cao";
            $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "khoa-dtnc"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(6), 'link' => "khoa-dtnc/"]);
            $DTNCPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('publicPage/masterPage', $DTNCPage);
        } else {
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Khoa đào tạo nâng cao";
            $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('38', $link), 'link' => "khoa-dtnc"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(6), 'link' => "khoa-dtnc/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
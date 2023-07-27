<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class TCHCController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('51');
        $gioithieu = $this->cmpbService->getCatalogueByID('54');
        $masterPage = [];
        $title = "Phòng tổ chức";
        $page = 'pages/officePage';
        $dataLayout['Banner'] = "Phòng tổ chức";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('54');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('51');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "phong-to-chuc";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueTCHC($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('8', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('8', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Phòng tổ chức";
            $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "phong-to-chuc"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(8), 'link' => "phong-to-chuc/"]);
            $TCHCPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('masterPage', $TCHCPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Phòng tổ chức";
            $dataLayout['content'] = view('pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('51', $link), 'link' => "phong-to-chuc"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(8), 'link' => "phong-to-chuc/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }
    }
}

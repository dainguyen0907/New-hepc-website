<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class CNDTTDHController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('34');
        $gioithieu = $this->cmpbService->getCatalogueByID('31');
        $masterPage = [];
        $title = "Khoa công nghệ điện tử - tự động hoá";
        $page = 'pages/officePage';
        $dataLayout['Banner'] = "Khoa công nghệ điện tử - tự động hoá";
        $dataLayout['f_name_catalogue'] = $gioithieu['name'];
        $dataLayout['s_name_catalogue'] = $tintuc['name'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('31');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('34');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "khoa-cndt-tdh";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueCNDTTDH($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('5', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('5', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['name'];
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Khoa công nghệ điện tử - tự động hoá";
            $dataLayout['content'] = view('pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "khoa-cndt-tdh"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(5), 'link' => "khoa-cndt-tdh/"]);
            $CNDTTDHPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('masterPage', $CNDTTDHPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Khoa công nghệ điện tử - tự động hoá";
            $dataLayout['content'] = view('pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('31', $link), 'link' => "khoa-cndt-tdh"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(5), 'link' => "khoa-cndt-tdh/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
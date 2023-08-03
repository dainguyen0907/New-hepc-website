<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;
use App\Services\fileAnhService;

class CNDTTDHController extends BaseController
{
    private $baivietService;
    private $cmpbService;
    private $anhService;

    public function __construct()
    {
        $this->baivietService = new baivietService();
        $this->cmpbService = new cmphongbanService();
        $this->anhService=new fileAnhService();
    }
    public function index()
    {
        $tintuc = $this->cmpbService->getCatalogueByID('34');
        $gioithieu = $this->cmpbService->getCatalogueByID('31');
        $masterPage = [];
        $title = "Khoa công nghệ điện tử - tự động hoá";
        $page = 'publicPage/pages/officePage';
        $dataLayout['Banner'] = "Khoa công nghệ điện tử - tự động hoá";
        $dataLayout['f_name_catalogue'] = $gioithieu['cmphongban'];
        $dataLayout['s_name_catalogue'] = $tintuc['cmphongban'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('31');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('34');
        $dataLayout['image'] = null;
        $dataLayout['album']=$this->anhService->getPicturesById_PB('5');
        $dataLayout['link'] = "khoa-cndt-tdh/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueCNDTTDH($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('5', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('5', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['cmphongban'];
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Khoa công nghệ điện tử - tự động hoá";
            $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "khoa-cndt-tdh"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(5), 'link' => "khoa-cndt-tdh/"]);
            $CNDTTDHPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('publicPage/masterPage', $CNDTTDHPage);
        } else {
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Khoa công nghệ điện tử - tự động hoá";
            $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('31', $link), 'link' => "khoa-cndt-tdh"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(5), 'link' => "khoa-cndt-tdh/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
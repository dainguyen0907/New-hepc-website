<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;
use App\Services\fileAnhService;

class TCKTController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('61');
        $gioithieu = $this->cmpbService->getCatalogueByID('60');
        $masterPage = [];
        $title = "Phòng tài chính";
        $page = 'publicPage/pages/officePage';
        $dataLayout['Banner'] = "Phòng tài chính";
        $dataLayout['f_name_catalogue'] = $gioithieu['cmphongban'];
        $dataLayout['s_name_catalogue'] = $tintuc['cmphongban'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('60');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('61');
        $dataLayout['image'] = null;
        $dataLayout['album']=$this->anhService->getPicturesById_PB('9');
        $dataLayout['link'] = "phong-tai-chinh/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueTCKT($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('9', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('9', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['cmphongban'];
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Phòng tài chính kế toán";
            $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForPage($catalogue['id_cmpb']), 'link' => "phong-tai-chinh"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(9), 'link' => "phong-tai-chinh/"]);
            $TCKTPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('publicPage/masterPage', $TCKTPage);
        } else {
            $page = 'subMasterPage';
            $dataLayout['Banner'] = "Phòng tài chính kế toán";
            $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('57', $link), 'link' => "phong-tai-chinh"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(9), 'link' => "phong-tai-chinh/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
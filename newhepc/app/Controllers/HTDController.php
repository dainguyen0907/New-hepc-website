<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;
use App\Services\fileAnhService;

class HTDController extends BaseController
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
        $tintuc = $this->cmpbService->getCatalogueByID('5');
        $gioithieu = $this->cmpbService->getCatalogueByID('2');
        $masterPage = [];
        $title = "Khoa hệ thống điện";
        $page = 'publicPage/pages/officePage';
        $dataLayout['Banner'] = "Khoa hệ thống điện";
        $dataLayout['f_name_catalogue'] = $gioithieu['cmphongban'];
        $dataLayout['s_name_catalogue'] = $tintuc['cmphongban'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('2');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('5');
        $dataLayout['image'] = null;
        $dataLayout['album']=$this->anhService->getPicturesById_PB('1');
        $dataLayout['link'] = "khoa-htd/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueHTD($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('1', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('1', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['cmphongban'];
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Khoa hệ thống điện";
            $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForCatalogue($catalogue['id_cmpb']), 'link' => "khoa-htd"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(1), 'link' => "khoa-htd/"]);
            $HTDPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('publicPage/masterPage', $HTDPage);
        } else {
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Khoa hệ thống điện";
            $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('2', $link), 'link' => "khoa-htd"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForOffice', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(1), 'link' => "khoa-htd/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
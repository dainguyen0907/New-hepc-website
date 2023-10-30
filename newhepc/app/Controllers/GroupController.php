<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class GroupController extends BaseController
{
    // PB- DOAN THANH NIEN ID=17
    //CM GIOI THIEU ID=129 TIN TUC ID=130
    private $baivietService;
    private $cmpbService;

    public function __construct()
    {
        $this->baivietService = new baivietService();
        $this->cmpbService = new cmphongbanService();
    }
    public function index()
    {
        $tintuc=$this->cmpbService->getCatalogueByID('130');
        $gioithieu=$this->cmpbService->getCatalogueByID('129');
        $masterPage = [];
        $title = "Đoàn thanh niên";
        $page = 'publicPage/pages/officePage';
        $dataLayout['Banner'] = "Đoàn thanh niên";
        $dataLayout['f_name_catalogue'] = $gioithieu['cmphongban'];
        $dataLayout['s_name_catalogue'] = $tintuc['cmphongban'];
        $dataLayout['f_link'] = $gioithieu['link'];
        $dataLayout['s_link'] = $tintuc['link'];
        $dataLayout['f_news'] = $this->baivietService->getNewsforOfficePage('129');
        $dataLayout['s_news'] = $this->baivietService->getNewsforOfficePage('130');
        $dataLayout['image'] = null;
        $dataLayout['link'] = "hoat-dong-doan/";
        $UnionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $UnionPage);
    }

    public function getNewsOfCatalogueGroup($link)
    {
        $catalogue = $this->cmpbService->getCatalogueByLink('17', $link);
        $newdetail = $this->baivietService->getNewDetailByID_PB('17', $link);
        if ($catalogue == null && $newdetail == null) {
            return $this->load404page();
        } elseif ($catalogue != null) {
            $masterPage = [];
            $title = $catalogue['cmphongban'];
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Đoàn thanh niên";
            $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForPage($catalogue['id_cmpb']), 'link' => "hoat-dong-doan"]);
            $dataLayout['Pager'] = $this->baivietService->getPager();
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForNew', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(17), 'link' => "hoat-dong-doan/"]);
            $GroupPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
            return view('publicPage/masterPage', $GroupPage);
        } else {
            $page = 'publicPage/subMasterPage';
            $dataLayout['Banner'] = "Công đoàn";
            $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('130', $link), 'link' => "hoat-dong-doan"]);
            $dataLayout['Pager'] = null;
            $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForNew', ['Newest' => $this->baivietService->getAnouncementForRightMenu(), 'catalogues' => $this->cmpbService->getCatalogues(17), 'link' => "hoat-dong-doan/"]);
            return $this->checkPageExits($newdetail, $page, $dataLayout);
        }

    }
}
<?php

namespace App\Controllers;

use App\Services\baivietService;

class AdmissionController extends BaseController
{
    private $baivietService;

    public function __construct()
    {
        $this->baivietService = new baivietService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Tuyển sinh";
        $page = 'publicPage/subMasterPage';
        $dataLayout['Banner'] = "Tuyển sinh";
        $dataLayout['content'] = view('publicPage/pages/newsPage', ['News' => $this->baivietService->getNewForPage('133'), 'link' => 'tuyen-sinh']);
        $dataLayout['Pager'] = $this->baivietService->getPager();
        $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForNew', ['Newest' => $this->baivietService->getAnouncementForRightMenu()]);
        $AdmissionPage = $this->loadLayout($masterPage, $title, $page, $dataLayout, [], []);
        return view('publicPage/masterPage', $AdmissionPage);
    }

    public function getAdmissionDetail($link)
    {
        $newdetail = $this->baivietService->getNewDetail('133', $link);
        $page = 'publicPage/subMasterPage';
        $dataLayout['Banner'] = "Tuyển sinh";
        $dataLayout['content'] = view('publicPage/pages/newDetail', ['New' => $newdetail, 'More' => $this->baivietService->getMoreNew('133', $link), 'link' => "tuyen-sinh"]);
        $dataLayout['Pager'] = null;
        $dataLayout['rightBanner'] = view('publicPage/layouts/rightMenuForNew', ['Newest' => $this->baivietService->getAnouncementForRightMenu()]);
        return $this->checkPageExits($newdetail, $page, $dataLayout);
    }
}
<?php

namespace App\Controllers;
use App\Common\libary;
use App\Services\admin_nhatkyService;


class Admin_HistoryController extends BaseController
{
    private $historyService;
    public function __construct()
    {
        $this->historyService=new admin_nhatkyService();
    }
    public function index()
    {
        $masterPage = [];
        $title = "Nhật ký";
        $cssLib = [libary::cssDatatables];
        $jsLib = [libary::jsDataTables,"assets/js/modal.js"];
        $page = 'adminPage/pages/historyPage';
        $dataLayout['history']=$this->historyService->getAllHistory();
        $AdmissionPage = $this->loadAdminLayout($masterPage, $title, $page, $dataLayout, $cssLib, $jsLib);
        return view('adminPage/masterPage', $AdmissionPage);
    }
}
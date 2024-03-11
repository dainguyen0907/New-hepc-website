<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;

class UnionController extends BaseController
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
        return $this->loadDepartmentPage(16,127,128,"Công đoàn",'cong-doan/');
    
    }

    public function getNewsOfCatalogueUnion($link)
    {
        return $this->loadNewDetailPage($link,16,"Công đoàn",'cong-doan');
    }
}
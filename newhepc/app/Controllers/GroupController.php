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
    
        return $this->loadDepartmentPage(17,129,130,"Hoạt động đoàn",'hoat-dong-doan/');
    }

    public function getNewsOfCatalogueGroup($link)
    {
        return $this->loadNewDetailPage($link,17,"Hoạt động đoàn",'hoat-dong-doan');
    }
}
<?php

namespace App\Controllers;

use App\Services\cmphongbanService;
use App\Services\baivietService;
use App\Services\fileAnhService;

class DTNCController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(6,41,38,"Phòng đào tạo nâng cao",'khoa-dtnc/');
    }

    public function getNewsOfCatalogueDTNC($link)
    {
        return $this->loadNewDetailPage($link,6,"Phòng đào tạo nâng cao",'khoa-dtnc');
    }
}
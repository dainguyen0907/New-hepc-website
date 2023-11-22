<?php

namespace App\Controllers;

class QLKHController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(10,66,63,"Phòng Quản lí Kế hoạch - Quan hệ Quốc tế",'phong-qlkh/');
    }

    public function getNewsOfCatalogueQLKH($link)
    {
        return $this->loadNewDetailPage($link,10,"Phòng quản lí Kế hoạch - Quan hệ Quốc tế",'phong-qlkh');
    }
}
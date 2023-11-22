<?php

namespace App\Controllers;


class QLHSSVController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(11,72,69,"Phòng Quản lí Học sinh - Sinh viên",'phong-qlhssv/');
    }

    public function getNewsOfCatalogueQLHSSV($link)
    {
        return $this->loadNewDetailPage($link,11,"Phòng Quản lí Học sinh - Sinh viên",'phong-qlhssv');
    }
}
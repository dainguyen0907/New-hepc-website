<?php

namespace App\Controllers;

class KHCBKTController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(4,23,27,"Khoa Khoa học Cơ bản - Kinh tế",'khoa-khcb-kt/');
    }

    public function getNewsOfCatalogueKHCBKT($link)
    {
        return $this->loadNewDetailPage($link,4,"Khoa Khoa học Cơ bản - Kinh tế",'khoa-khcb-kt');
    }
}
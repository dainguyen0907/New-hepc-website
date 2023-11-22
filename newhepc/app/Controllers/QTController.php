<?php

namespace App\Controllers;


class QTController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(12,78,79,"Phòng quản trị",'phong-quan-tri/');
    }

    public function getNewsOfCatalogueQT($link)
    {
        return $this->loadNewDetailPage($link,12,"Phòng Quản trị",'phong-quan-tri');
    }
}
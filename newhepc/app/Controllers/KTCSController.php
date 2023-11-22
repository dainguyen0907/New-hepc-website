<?php

namespace App\Controllers;

class KTCSController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(2,9,12,"Khoa kỹ thuật cơ sở",'khoa-ktcs/');
    }

    public function getNewsOfCatalogueKTCS($link)
    {
        return $this->loadNewDetailPage($link,2,"Khoa kỹ thuật cơ sở",'khoa-ktcs');
    }
}
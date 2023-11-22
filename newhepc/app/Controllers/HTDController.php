<?php

namespace App\Controllers;

class HTDController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(1,2,5,"Khoa hệ thống điện",'khoa-htd/');
    }

    public function getNewsOfCatalogueHTD($link)
    {
        return $this->loadNewDetailPage($link,1,"Khoa hệ thống điện",'khoa-htd');
    }
}
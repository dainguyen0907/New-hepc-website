<?php

namespace App\Controllers;

class DCNController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(3,16,19,"Khoa điện công nghiệp",'khoa-dcn/');
    }

    public function getNewsOfCatalogueDCN($link)
    {
        return $this->loadNewDetailPage($link,3,"Khoa điện công nghiệp",'khoa-dcn');
    }
}
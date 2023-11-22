<?php

namespace App\Controllers;
class DTController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(7,48,45,"Phòng đào tạo",'phong-dao-tao/');
    }

    public function getNewsOfCatalogueDT($link)
    {
        return $this->loadNewDetailPage($link,7,"Phòng đào tạo",'phong-dao-tao');
    }
}
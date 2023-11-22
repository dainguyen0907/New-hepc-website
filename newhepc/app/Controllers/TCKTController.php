<?php

namespace App\Controllers;

class TCKTController extends BaseController
{
    public function index()
    {
        return $this->loadDepartmentPage(9,60,61,"Phòng Tài chính","phong-tai-chinh/");
    }

    public function getNewsOfCatalogueTCKT($link)
    {
        return $this->loadNewDetailPage($link,9,"Phòng tài chính",'phong-tai-chinh');
    }
}